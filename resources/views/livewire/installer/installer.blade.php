<div>
    <main class="d-flex w-100 h-100" x-data="initAlpine">
		<div class="container d-flex flex-column">
			<div class="row vh-100">
				<div class="col-sm-10 col-md-8 col-lg-4 mx-auto d-table h-100">
					<div class="d-table-cell align-middle">
                        <div x-show="page == 0">
                            <div class="card">
                                <div class="card-body">
                                    <div class="m-sm-4">
                                        <div class="text-center ">
                                            <h1>{{__('all.app_name')}}</h1>
                                        </div>
                                        <div class="mb-4">
                                            <p>{{__('all.start_installation_text')}}</p>
                                        </div>
                                        <form>
                                            <div class="text-center mt-3">
                                                <a href="#" class="btn btn-lg btn-primary" @click.prevent="startInstall">{{__('all.start_installation')}}</a>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div x-show="page == 1">
                            <div class="card">
                                <div class="card-body">
                                    <div class="m-sm-4">
                                        <div class="text-center ">
                                            <h1>{{__('all.app_name')}}</h1>
                                        </div>
                                        <div class="mb-4">
                                            <p>{{__('all.checking_requirements')}}</p>
                                        </div>
                                        <form>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div x-show="page == 3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="m-sm-4">
                                        <div class="text-center ">
                                            <h1>{{__('all.app_name')}}</h1>
                                        </div>
                                        <form>
                                            <template x-for="(extension,i) in extensions" :key="i">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div class="" x-text="i">
                                                        
                                                    </div>
                                                    <div x-show="extension == 1">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-checkbox" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="green" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                            <polyline points="9 11 12 14 20 6"></polyline>
                                                            <path d="M20 12v6a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h9"></path>
                                                        </svg>
                                                    </div>
                                                    <div x-show="extension == 0">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-x" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="red" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                            <line x1="18" y1="6" x2="6" y2="18"></line>
                                                            <line x1="6" y1="6" x2="18" y2="18"></line>
                                                        </svg>
                                                    </div>
                                                </div>
                                            </template>
                                            <div class="text-center mt-3">
                                                <a href="#" class="btn btn-lg btn-primary" @click.prevent="continueInstall">{{__('all.continue_installation')}}</a>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div x-show="page == 4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="m-sm-4">
                                        <div class="text-center ">
                                            <h1>{{__('all.app_name')}}</h1>
                                        </div>
                                        <div class="">
                                            <p>{{__('all.enter_database_info')}}</p>
                                        </div>
                                        <form>
                                            <div class="mb-2">
                                                <label class="form-label">{{__('all.database_host')}}</label>
                                                <input type="text" class="form-control"  wire:model="host">
                                                @error('host')
                                                    <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                            <div class="mb-2">
                                                <label class="form-label">{{__('all.database_port')}}</label>
                                                <input type="text" class="form-control" wire:model="port">
                                                @error('port')
                                                    <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                            <div class="mb-2">
                                                <label class="form-label">{{__('all.database_name')}}</label>
                                                <input type="text" class="form-control" wire:model="name">
                                                @error('name')
                                                    <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                            <div class="mb-2">
                                                <label class="form-label">{{__('all.database_username')}}</label>
                                                <input type="text" class="form-control" wire:model="username">
                                                @error('username')
                                                    <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                            <div class="mb-2">
                                                <label class="form-label">{{__('all.database_password')}}</label>
                                                <input type="text" class="form-control" wire:model="password">
                                                @error('password')
                                                    <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                            <div class="">
                                                <span class="text-danger error">{{$errormessage}}</span>
                                            </div>
                                            <div class="progress" x-show="action == true">
                                                <div class="progress-bar progress-bar-indeterminate bg-green"></div>
                                            </div>
                                            <div class="text-center mt-3">
                                                <a href="#" class="btn btn-lg btn-primary" @click.prevent="checkDatabase">{{__('all.continue_installation')}}</a>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div x-show="page == 5">
                            <div class="card">
                                <div class="card-body">
                                    <div class="m-sm-4">
                                        <div class="text-center ">
                                            <h1>{{__('all.app_name')}}</h1>
                                        </div>
                                        <div class="">
                                            <p>{{__('all.installing')}}</p>
                                        </div>
                                        <form>
                                            <div class="progress">
                                                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
                                              </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div x-show="page == 6">
                            <div class="card card-md"  x-cloak>
                                <div class="card-body text-center py-4 p-sm-5">
                                    <div class="text-center ">
                                        <h1>{{__('all.app_name')}}</h1>
                                    </div>
                                    <h3 class="mt-5">{{__('all.install_complete')}}</h3>
                                    <a :href="url"><button class="btn btn-success">{{__('all.go_to_dashboard')}}</button></a>
                                    <p class="mt-2">{{__('all.your_email_is')}}</p>
                                    <p>{{__('all.your_password_is')}}</p>
                                </div>
                            </div>
                        </div>
					</div>
				</div>
			</div>
		</div>
	</main>


    <script>
        function initAlpine()
        {
            return{
                page : 0,
                action : false,
                extensions : [],
                url : '',
                init()
                {
                    this.url = location.protocol + '//' + location.host+'/admin/dashboard';
                },
                startInstall()
                {
                    if(this.page == 0)
                    {
                        this.page = 1;
                        this.action = true;
                        this.$wire.checkRequirements().then((result) => {
                            if(result.success == true)
                            {
                                this.page = 3;
                                this.action = false;
                                this.extensions = result.data;
                                
                            }
                        })
                    }
                },
                continueInstall()
                {
                    this.page = 4;
                },
                checkDatabase()
                {
                    this.$wire.checkDatabase().then(result => {
                        if(result == true)
                        {
                            this.page =5;
                            this.$wire.startInstallation().then(response => {
                                this.page = 6
                            });
                        }
                    })
                }
            }
        }

    </script>
</div>
