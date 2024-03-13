<?php

namespace App\Http\Livewire\Installer;

use Livewire\Component;
use App\Http\Classes\Requirement;
use App\Models\User;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Jackiedo\DotenvEditor\Facades\DotenvEditor;
class Installer extends Component
{
    public $extensions,$directories,$errormessage,$page,$step=1,$requirement_satisfied =false;
    public $host='localhost',$port=3306,$username,$password,$name,$dberror =true;
    /* render the page */
    public function render()
    {
        return view('livewire.installer.installer')->layout('layouts.installer');
    }
    /* process before render */
    public function mount()
    {
        $installFile = File::exists(base_path('install'));
        if (!$installFile) {
            return redirect('');
        }
    }
    /* check all requirments */
    public function checkRequirements()
    {
        $requirement = new Requirement();
        $this->extensions = $requirement->extensions();
        $this->directories = $requirement->directories();
        $this->requirement_satisfied = $requirement->satisfied();
        if($this->requirement_satisfied == true)
        {
            return [
                'success'=> true,
                'data'  => $this->extensions
            ];
        }
        return false;
    }
    /* check database */
    public function checkDatabase()
    {
        $this->dberror = true;
        $this->validate([
            'host'  => 'required',
            'port'  => 'required|numeric',
            'username'  => 'required',
            'name'  => 'required'
        ]);
        $error =false;
        try{
            $connection = mysqli_connect($this->host,$this->username,$this->password,$this->name,$this->port);
        }
        catch(\Exception $e)
        {
            $error = $e->getMessage();
        }
        if($error == false)
        {
            $this->dberror = false;
            return true;
        }
        else{
            $this->dberror = true;
        }
        $this->errormessage = $error;
        return $error;
    }
    /* setup installtion */
    public function startInstallation()
    {
        if(!$this->step == 5)
        return;
        config([
            'database.default' => 'mysql',
            'database.connections.mysql.host' => $this->host,
            'database.connections.mysql.port' => $this->port,
            'database.connections.mysql.database' => $this->name,
            'database.connections.mysql.username' => $this->username,
            'database.connections.mysql.password' => $this->password
        ]);
        $editor = DotenvEditor::setKeys([
            'DB_HOST'   => $this->host,
            'DB_PORT'   => $this->port,
            'DB_DATABASE'   => $this->name,
            'DB_USERNAME'   => $this->username,
            'DB_PASSWORD'   => $this->password
        ]);
        $editor->save();
        DB::reconnect('mysql');
        DB::getPdo('mysql');
        Artisan::call('migrate:fresh');
        Artisan::call('db:seed');
        Artisan::call('optimize');
        Artisan::call('config:cache');
        File::delete(base_path('install'));
        $this->step = 7;
        $user = User::whereUserType(1)->first();
        Auth::login($user);
        return true;
    }

}
