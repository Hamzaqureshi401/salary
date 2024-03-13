<div>
    <nav class="navbar navbar-expand navbar-light {{ Request::is('admin/pos') ? 'bg-dark' : '' }} navbar-bg">
        @if (!Request::is('admin/pos'))
            <a class="sidebar-toggle js-sidebar-toggle">
                <i class="hamburger align-self-center"></i>
            </a>
        @endif
        <div class="navbar-collapse collapse">
            <ul class="navbar-nav navbar-align">
                @if (Request::is('admin/pos'))
                    <li class="mr-10">
                        <a class="btn btn-success" data-bs-toggle="modal" data-bs-target="#ModalCooking"
                            wire:click="$emit('loadCook')">{{ $lang->data['cooking_status'] ?? 'Cooking Status' }}</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.dashboard') }}"
                            class="btn btn-primary">{{ $lang->data['back_to_dashboard'] ?? 'Back to Dashboard' }} </a>
                    </li>
                @endif
                @if ($translations && count($translations) > 0)
                    <li class="nav-item dropdown">
                        @if ($lang != null)
                            <a class="nav-flag dropdown-toggle" href="#" id="languageDropdown"
                                data-bs-toggle="dropdown">
                                <img src="{{ asset($lang->photo()) }}" alt="English" />
                            </a>
                        @else
                            <a class="nav-flag dropdown-toggle" href="#" id="languageDropdown"
                                data-bs-toggle="dropdown">
                                <img src="{{ asset('assets/img/flags/us.png') }}" alt="English" />
                            </a>
                        @endif
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="languageDropdown">
                            @foreach ($translations as $translation)
                                <a class="dropdown-item" href="#"
                                    wire:click="changeLanguage({{ $translation->id ?? '' }})">
                                    <img src="{{ asset($translation->photo()) }}" width="20"
                                        class="align-middle me-1" />
                                    <span class="align-middle">{{ $translation->name }}</span>
                                </a>
                            @endforeach
                        </div>
                    </li>
                @endif
                <li class="nav-item">
                    <a class="nav-icon js-fullscreen d-none d-lg-block" href="#">
                        <div class="position-relative">
                            <i class="align-middle" data-feather="maximize"></i>
                        </div>
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-icon pe-md-0 dropdown-toggle" href="#" data-bs-toggle="dropdown">
                        <img src="{{ asset('assets/img/photos/no-user.jpg') }}" class="avatar img-fluid rounded"
                            alt="Charles Hall" />
                    </a>
                    <div class="dropdown-menu dropdown-menu-end">
                        <a class="dropdown-item" href="{{route('admin.account_settings')}}"><i class="align-middle me-1"
                                data-feather="user"></i> Account Settings</a>
                        <a class="dropdown-item" href="{{route('admin.app_settings')}}"><i class="align-middle me-1"
                                data-feather="settings"></i> App Settings</a>
                        <a class="dropdown-item" href="#" wire:click="logout">Log out</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</div>
