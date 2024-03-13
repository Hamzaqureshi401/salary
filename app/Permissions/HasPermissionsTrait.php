<?php
namespace App\Permissions;

use App\Models\Permission;

trait HasPermissionsTrait {

  public function hasPermissionTo($permission) {
    return  $this->hasPermission($permission);
  }
  /* Staff Permission */
  public function permissions() {
    return $this->belongsToMany(Permission::class,'model_permissions');
  }
  protected function hasPermission($permission) {
    return (bool) $this->permissions->where('slug', $permission->slug)->count();
  }
}
