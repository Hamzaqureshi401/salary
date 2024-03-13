<div>
		<main class="d-flex w-100 h-100">
		<div class="container d-flex flex-column">
			<div class="row vh-100">
				<div class="col-sm-10 col-md-8 col-lg-4 mx-auto d-table h-100">
					<div class="d-table-cell align-middle">
						
						<div class="card">
							<div class="card-body">
								<div class="m-sm-4">
									<div class="text-center mb-4">
										<h1>{{getStoreName()}}</h1>
									</div>
									<form>
										<div class="mb-3">
											<label class="form-label">{{$lang->data['email']??'Email'}}</label>
											<input class="form-control form-control-lg" type="email" name="email" placeholder="{{$lang->data['enter_email']??'Enter your email'}}" wire:model='email'/>
											@error('email')
												<span class="text-danger">{{$message}}</span>
											@enderror
										</div>
										<div class="mb-3">
											<label class="form-label">{{$lang->data['password']??'Password'}}</label>
											<input class="form-control form-control-lg " type="password" name="password" placeholder="{{$lang->data['enter_password']??'Enter your password'}}" wire:model='password'/>
											@error('password')
												<span class="text-danger d-block">{{$message}}</span>
											@enderror
											@error('login_error')
												<span class="text-danger d-block">{{$message}}</span>
											@enderror
										</div>
										<div>
											<label class="form-check">
												<input class="form-check-input" type="checkbox" value="remember-me" name="remember-me" checked>
												<span class="form-check-label">
													{{$lang->data['remember_me_next']??'Remember me next time'}}
												</span>
											</label>
										</div>
										<div class="text-center mt-3">
											<a href="#" class="btn btn-lg btn-primary" wire:click.prevent='login'>{{$lang->data['sign_in']??'Sign in'}}</a>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</main>
</div>