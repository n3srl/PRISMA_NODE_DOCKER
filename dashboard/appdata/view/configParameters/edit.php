<?php /* @var $ConfigParameters ConfigParameters */ ?> 
<div class='right_col' role='main'>
	<div class=''>
		<div class='page-title'>
			<div class='title_left'>
				<h2><?= _('ConfigParameters') ?></h2>
			</div>
		</div>
			<div class='clearfix'></div>
				<div class='row'>
					<div class='col-md-12 col-sm-12 col-xs-12'>
					<div id='list' class='x_panel'>
						<div class='x_title no-padding-lr'>
							<div class='clearfix'>
								<div class='col-md-6 no-padding-l'>
									<h2><?= _('Elenco') ?></h2>
								</div>
									<div class='col-md-6 no-padding'>
										<a href = '#edit' ><button type='button' onclick='newObj()' style='margin-right: 10px' class='btn btn-success pull-right' ><?= _('AGGIUNGI NUOVO PARAMETRO DI CONFIGURAZIONE') ?></button></a>
									</div>
								</div>
							</div>
							<div class='x_panel filter-container'>
								<div class='x_title filter-title-container collapse-link'>
									<div class='filter-title'>
										<h2 class='font-15'>Filtra per...</h2>
										<ul class='nav navbar-right panel_toolbox'>
											<li><a class='black'><i class='fa fa-chevron-down'></i></a>
											</li>
										</ul>
									</div>
								<div class='clearfix'></div>
							</div>
							<div class='x_content filter-content' hidden>
								<div class='form-group col-md-3 col-sm-6 col-xs-12 b80bb7740288fda1f201890375a60c8f'>
									<div class='form-group'>
										<div class='col-xs-12'>
											<small class='text-muted'><?php echo (_('id')) ?></small>
											<select class='form-control filter filter-text' id='F_id' multiple='multiple' title='<?php echo (_('Filtra per id')) ?>'>
											</select>
										</div>
									</div>
								</div>
								<div class='form-group col-md-3 col-sm-6 col-xs-12 130f43112bb8a7a7790ebfc08ee9d6af'>
									<div class='form-group'>
										<div class='col-xs-12'>
											<small class='text-muted'><?php echo (_('oid')) ?></small>
											<select class='form-control filter filter-text' id='F_oid' multiple='multiple' title='<?php echo (_('Filtra per oid')) ?>'>
											</select>
										</div>
									</div>
								</div>
								<div class='col-md-3 col-sm-6 col-xs-12 fbb3de1fbadfec635a10cf42b4dd553d'>
									<div class='form-group'>
										<div class='col-xs-12'>
											<small class='text-muted'><?php echo (_('general_quiet')) ?></small>
											<select class='form-control filter filter-checkbox' id='F_general_quiet' title='<?php echo (_('Filtra per general_quiet')) ?>'>
												<option value=''></option>
												<option value='1'> <?php echo (_('Sì')) ?></option>
												<option value='0'> <?php echo (_('No')) ?></option>
											</select>
										</div>
									</div>
								</div>
								<div class='col-md-3 col-sm-6 col-xs-12 e6bc30a9ad6bffe3c4491909eb57f055'>
									<div class='form-group'>
										<div class='col-xs-12'>
											<small class='text-muted'><?php echo (_('general_on_error')) ?></small>
											<select class='form-control filter filter-checkbox' id='F_general_on_error' title='<?php echo (_('Filtra per general_on_error')) ?>'>
												<option value=''></option>
												<option value='1'> <?php echo (_('Sì')) ?></option>
												<option value='0'> <?php echo (_('No')) ?></option>
											</select>
										</div>
									</div>
								</div>
								<div class='col-md-3 col-sm-6 col-xs-12 408c8599b283519fd4b08d3d32d891ad'>
									<div class='form-group'>
										<div class='col-xs-12'>
											<small class='text-muted'><?php echo (_('general_except')) ?></small>
											<select class='form-control filter filter-checkbox' id='F_general_except' title='<?php echo (_('Filtra per general_except')) ?>'>
												<option value=''></option>
												<option value='1'> <?php echo (_('Sì')) ?></option>
												<option value='0'> <?php echo (_('No')) ?></option>
											</select>
										</div>
									</div>
								</div>
								<div class='form-group col-md-3 col-sm-6 col-xs-12 c41d8eacab702b1cc6eb8dc463a09b78'>
									<div class='form-group'>
										<div class='col-xs-12'>
											<small class='text-muted'><?php echo (_('image_report_photo')) ?></small>
											<select class='form-control filter filter-text' id='F_image_report_photo' multiple='multiple' title='<?php echo (_('Filtra per image_report_photo')) ?>'>
											</select>
										</div>
									</div>
								</div>
								<div class='form-group col-md-3 col-sm-6 col-xs-12 48ffa3b57760fd76994336bc843d078b'>
									<div class='form-group'>
										<div class='col-xs-12'>
											<small class='text-muted'><?php echo (_('daily_report_astro')) ?></small>
											<select class='form-control filter filter-text' id='F_daily_report_astro' multiple='multiple' title='<?php echo (_('Filtra per daily_report_astro')) ?>'>
											</select>
										</div>
									</div>
								</div>
								<div class='form-group col-md-3 col-sm-6 col-xs-12 14c22edbf95936460cdf7cf242e877c2'>
									<div class='form-group'>
										<div class='col-xs-12'>
											<small class='text-muted'><?php echo (_('daily_histo')) ?></small>
											<select class='form-control filter filter-text' id='F_daily_histo' multiple='multiple' title='<?php echo (_('Filtra per daily_histo')) ?>'>
											</select>
										</div>
									</div>
								</div>
								<div class='form-group col-md-3 col-sm-6 col-xs-12 a414415358929c55c8d0c8a5e9bef7c9'>
									<div class='form-group'>
										<div class='col-xs-12'>
											<small class='text-muted'><?php echo (_('monthly_report_astro')) ?></small>
											<select class='form-control filter filter-text' id='F_monthly_report_astro' multiple='multiple' title='<?php echo (_('Filtra per monthly_report_astro')) ?>'>
											</select>
										</div>
									</div>
								</div>
								<div class='form-group col-md-3 col-sm-6 col-xs-12 1df5fa574c8df763d1c4e9c52732b840'>
									<div class='form-group'>
										<div class='col-xs-12'>
											<small class='text-muted'><?php echo (_('monthly_histo')) ?></small>
											<select class='form-control filter filter-text' id='F_monthly_histo' multiple='multiple' title='<?php echo (_('Filtra per monthly_histo')) ?>'>
											</select>
										</div>
									</div>
								</div>
								<div class='form-group col-md-3 col-sm-6 col-xs-12 ecd38d0d3cd87a312efb5fdf7fb4dcc1'>
									<div class='form-group'>
										<div class='col-xs-12'>
											<small class='text-muted'><?php echo (_('event_fill_frames')) ?></small>
											<select class='form-control filter filter-text' id='F_event_fill_frames' multiple='multiple' title='<?php echo (_('Filtra per event_fill_frames')) ?>'>
											</select>
										</div>
									</div>
								</div>
								<div class='form-group col-md-3 col-sm-6 col-xs-12 b28d38d7aba1c0934494dc60004e6473'>
									<div class='form-group'>
										<div class='col-xs-12'>
											<small class='text-muted'><?php echo (_('event_recenter')) ?></small>
											<select class='form-control filter filter-text' id='F_event_recenter' multiple='multiple' title='<?php echo (_('Filtra per event_recenter')) ?>'>
											</select>
										</div>
									</div>
								</div>
								<div class='form-group col-md-3 col-sm-6 col-xs-12 1241219023975c06a7b67cd2f562fb9c'>
									<div class='form-group'>
										<div class='col-xs-12'>
											<small class='text-muted'><?php echo (_('event_box_bolide')) ?></small>
											<select class='form-control filter filter-text' id='F_event_box_bolide' multiple='multiple' title='<?php echo (_('Filtra per event_box_bolide')) ?>'>
											</select>
										</div>
									</div>
								</div>
								<div class='form-group col-md-3 col-sm-6 col-xs-12 d8e0b609204c974fb6dcf8ef684e109e'>
									<div class='form-group'>
										<div class='col-xs-12'>
											<small class='text-muted'><?php echo (_('event_model_psf')) ?></small>
											<select class='form-control filter filter-text' id='F_event_model_psf' multiple='multiple' title='<?php echo (_('Filtra per event_model_psf')) ?>'>
											</select>
										</div>
									</div>
								</div>
								<div class='form-group col-md-3 col-sm-6 col-xs-12 bb8df86ef619c9b9d7af3e8e152f307c'>
									<div class='form-group'>
										<div class='col-xs-12'>
											<small class='text-muted'><?php echo (_('event_model_bar')) ?></small>
											<select class='form-control filter filter-text' id='F_event_model_bar' multiple='multiple' title='<?php echo (_('Filtra per event_model_bar')) ?>'>
											</select>
										</div>
									</div>
								</div>
								<div class='form-group col-md-3 col-sm-6 col-xs-12 d6552b1fd85cccdfff17030c4eaa9ce5'>
									<div class='form-group'>
										<div class='col-xs-12'>
											<small class='text-muted'><?php echo (_('event_report')) ?></small>
											<select class='form-control filter filter-text' id='F_event_report' multiple='multiple' title='<?php echo (_('Filtra per event_report')) ?>'>
											</select>
										</div>
									</div>
								</div>
								<div class='form-group col-md-3 col-sm-6 col-xs-12 921dd7749221705bfe2f5899333b836b'>
									<div class='form-group'>
										<div class='col-xs-12'>
											<small class='text-muted'><?php echo (_('event_image')) ?></small>
											<select class='form-control filter filter-text' id='F_event_image' multiple='multiple' title='<?php echo (_('Filtra per event_image')) ?>'>
											</select>
										</div>
									</div>
								</div>
								<div class='form-group col-md-3 col-sm-6 col-xs-12 05cf6a760b8a736fa094e18d9d024509'>
									<div class='form-group'>
										<div class='col-xs-12'>
											<small class='text-muted'><?php echo (_('event_video')) ?></small>
											<select class='form-control filter filter-text' id='F_event_video' multiple='multiple' title='<?php echo (_('Filtra per event_video')) ?>'>
											</select>
										</div>
									</div>
								</div>
								<div class='form-group col-md-12 col-sm-12 col-xs-12'>
									<div class='form-group'>
										<div class='col-xs-12'>
											<button class="pull-right btn btn-success applyFilter" ><?= _("Applica filtri") ?></button>
										</div>
									</div>
								</div>
							</div>
						</div>
							<div class='x_content'>
								<table id='ConfigParametersList' class='table table-striped table-bordered' style='width: 100%; '>
									<thead>
									<tr>
										<th><?php echo (_('oid')) ?></th>
										<th><?php echo (_('general_quiet')) ?></th>
										<th><?php echo (_('general_on_error')) ?></th>
										<th><?php echo (_('general_except')) ?></th>
										<th><?php echo (_('image_report_photo')) ?></th>
										<th><?php echo (_('daily_report_astro')) ?></th>
										<th><?php echo (_('daily_histo')) ?></th>
										<th><?php echo (_('monthly_report_astro')) ?></th>
										<th><?php echo (_('monthly_histo')) ?></th>
										<th><?php echo (_('event_fill_frames')) ?></th>
										<th><?php echo (_('event_recenter')) ?></th>
										<th><?php echo (_('event_box_bolide')) ?></th>
										<th><?php echo (_('event_model_psf')) ?></th>
										<th><?php echo (_('event_model_bar')) ?></th>
										<th><?php echo (_('event_report')) ?></th>
										<th><?php echo (_('event_image')) ?></th>
										<th><?php echo (_('event_video')) ?></th>
										<th></th>
									</tr>
								</thead>
								<tbody>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<div class='col-md-12 col-sm-12 col-xs-12'>
					<form id='CompanyForm' method='POST' action='/service/configParameters/save/<?php echo $ConfigParameters->id;?>' class='form-horizontal form-label-left' novalidate>
						<div id='edit' class='x_panel'>
							<div class='x_title no-padding-lr'>
								<div class='clearfix'>
									<div class='col-md-8 no-padding'>
										<h2><?= _('Aggiungi nuovo') ?></h2>
									</div>
									<div class='col-md-4 no-padding'>
										<button type = 'button' style= 'display: none; margin-right: 10px;' id= 'deletebtn' class='btn btn-danger pull-right' onclick="removeObj()" ><?= _('ELIMINA') ?></button>
										<button type = 'submit' style= 'display: none; margin-right: 10px;' id= 'savebtn' class='btn btn-success pull-right' ><?= _('SALVA') ?></button>
										<button type = 'button' style='display: none; margin-right: 10px;' id='cleanbtn' onclick='newObj()' class='btn btn-clean pull-right cleanForm' ><?= _('PULISCI CAMPI') ?></button>
										<button type = 'button' style= 'display: none; margin-right: 10px;' id= 'modifybtn' onclick= 'allowEditObj();' class='btn btn-success btn-blue-success pull-right' ><?= _('MODIFICA') ?></button>
										<button type = 'button' style= 'display: none; margin-right: 10px;' id= 'undobtn' onclick= 'undoObj();' class='btn btn-warning btn-yellow-warning pull-right' ><?= _('ANNULLA') ?></button>
										<a href = '#list' ><button type='button' style='margin-right: 10px' class='btn btn-all pull-right' ><?= _('TUTTI') ?></button></a>
									</div>
								</div>
							</div>
							<div class='x_content'>
								<div class='col-md-12 col-sm-12 col-xs-12'>
									<div class='item form-group'>
										<label class='col-md-6 col-sm-6 col-xs-12' ><?= _('I campi contrassegnati con * sono obbligatori') ?></label>
									</div>
								</div>
								<div class='col-md-3 col-sm-6 col-xs-12 b80bb7740288fda1f201890375a60c8f'>
									<div class='item form-group'>
										<div class='col-xs-12'>
											<small class='text-muted'><?php echo ( _('id')) ?> </small>
											<input type = 'text' name='id' class='form-control col-md-7 col-xs-12 input-disabled' placeholder=' <?php echo ( _('id')) ?> '  title=' <?php echo ( _('id')) ?> '/>
										</div>
									</div>
								</div>
								<div class='col-md-3 col-sm-6 col-xs-12 130f43112bb8a7a7790ebfc08ee9d6af'>
									<div class='item form-group'>
										<div class='col-xs-12'>
											<small class='text-muted'><?php echo ( _('oid')) ?> </small>
											<input type = 'text' name='oid' class='form-control col-md-7 col-xs-12 input-disabled' placeholder=' <?php echo ( _('oid')) ?> '  title=' <?php echo ( _('oid')) ?>' maxlength = '32' />
										</div>
									</div>
								</div>
								<div class='col-md-3 col-sm-6 col-xs-12 fbb3de1fbadfec635a10cf42b4dd553d'>
									<div class='item form-group'>
										<div class='col-xs-12'>
											<label class='text-muted checkbox-label'><?php echo ( _('general_quiet')) ?></label>
											<input type = 'checkbox' onclick="$(this).val(this.checked ? 1 : 0)"  name='general_quiet' class='col-md-1 col-xs-1 checkbox input-disabled' placeholder='<?php echo ( _('general_quiet')) ?>' title='<?php echo ( _('general_quiet')) ?>'>
										</div>
									</div>
								</div>
								<div class='col-md-3 col-sm-6 col-xs-12 e6bc30a9ad6bffe3c4491909eb57f055'>
									<div class='item form-group'>
										<div class='col-xs-12'>
											<label class='text-muted checkbox-label'><?php echo ( _('general_on_error')) ?></label>
											<input type = 'checkbox' onclick="$(this).val(this.checked ? 1 : 0)"  name='general_on_error' class='col-md-1 col-xs-1 checkbox input-disabled' placeholder='<?php echo ( _('general_on_error')) ?>' title='<?php echo ( _('general_on_error')) ?>'>
										</div>
									</div>
								</div>
								<div class='col-md-3 col-sm-6 col-xs-12 408c8599b283519fd4b08d3d32d891ad'>
									<div class='item form-group'>
										<div class='col-xs-12'>
											<label class='text-muted checkbox-label'><?php echo ( _('general_except')) ?></label>
											<input type = 'checkbox' onclick="$(this).val(this.checked ? 1 : 0)"  name='general_except' class='col-md-1 col-xs-1 checkbox input-disabled' placeholder='<?php echo ( _('general_except')) ?>' title='<?php echo ( _('general_except')) ?>'>
										</div>
									</div>
								</div>
								<div class='col-md-3 col-sm-6 col-xs-12 c41d8eacab702b1cc6eb8dc463a09b78'>
									<div class='item form-group'>
										<div class='col-xs-12'>
											<small class='text-muted'><?php echo ( _('image_report_photo')) ?> <span class='required'>*</span></small>
											<input type = 'text' name='image_report_photo' required='required' class='form-control col-md-7 col-xs-12 input-disabled' placeholder=' <?php echo ( _('image_report_photo')) ?> '  title=' <?php echo ( _('image_report_photo')) ?>' maxlength = '3' />
										</div>
									</div>
								</div>
								<div class='col-md-3 col-sm-6 col-xs-12 48ffa3b57760fd76994336bc843d078b'>
									<div class='item form-group'>
										<div class='col-xs-12'>
											<small class='text-muted'><?php echo ( _('daily_report_astro')) ?> <span class='required'>*</span></small>
											<input type = 'text' name='daily_report_astro' required='required' class='form-control col-md-7 col-xs-12 input-disabled' placeholder=' <?php echo ( _('daily_report_astro')) ?> '  title=' <?php echo ( _('daily_report_astro')) ?>' maxlength = '3' />
										</div>
									</div>
								</div>
								<div class='col-md-3 col-sm-6 col-xs-12 14c22edbf95936460cdf7cf242e877c2'>
									<div class='item form-group'>
										<div class='col-xs-12'>
											<small class='text-muted'><?php echo ( _('daily_histo')) ?> <span class='required'>*</span></small>
											<input type = 'text' name='daily_histo' required='required' class='form-control col-md-7 col-xs-12 input-disabled' placeholder=' <?php echo ( _('daily_histo')) ?> '  title=' <?php echo ( _('daily_histo')) ?>' maxlength = '3' />
										</div>
									</div>
								</div>
								<div class='col-md-3 col-sm-6 col-xs-12 a414415358929c55c8d0c8a5e9bef7c9'>
									<div class='item form-group'>
										<div class='col-xs-12'>
											<small class='text-muted'><?php echo ( _('monthly_report_astro')) ?> <span class='required'>*</span></small>
											<input type = 'text' name='monthly_report_astro' required='required' class='form-control col-md-7 col-xs-12 input-disabled' placeholder=' <?php echo ( _('monthly_report_astro')) ?> '  title=' <?php echo ( _('monthly_report_astro')) ?>' maxlength = '3' />
										</div>
									</div>
								</div>
								<div class='col-md-3 col-sm-6 col-xs-12 1df5fa574c8df763d1c4e9c52732b840'>
									<div class='item form-group'>
										<div class='col-xs-12'>
											<small class='text-muted'><?php echo ( _('monthly_histo')) ?> <span class='required'>*</span></small>
											<input type = 'text' name='monthly_histo' required='required' class='form-control col-md-7 col-xs-12 input-disabled' placeholder=' <?php echo ( _('monthly_histo')) ?> '  title=' <?php echo ( _('monthly_histo')) ?>' maxlength = '3' />
										</div>
									</div>
								</div>
								<div class='col-md-3 col-sm-6 col-xs-12 ecd38d0d3cd87a312efb5fdf7fb4dcc1'>
									<div class='item form-group'>
										<div class='col-xs-12'>
											<small class='text-muted'><?php echo ( _('event_fill_frames')) ?> <span class='required'>*</span></small>
											<input type = 'text' name='event_fill_frames' required='required' class='form-control col-md-7 col-xs-12 input-disabled' placeholder=' <?php echo ( _('event_fill_frames')) ?> '  title=' <?php echo ( _('event_fill_frames')) ?>' maxlength = '3' />
										</div>
									</div>
								</div>
								<div class='col-md-3 col-sm-6 col-xs-12 b28d38d7aba1c0934494dc60004e6473'>
									<div class='item form-group'>
										<div class='col-xs-12'>
											<small class='text-muted'><?php echo ( _('event_recenter')) ?> <span class='required'>*</span></small>
											<input type = 'text' name='event_recenter' required='required' class='form-control col-md-7 col-xs-12 input-disabled' placeholder=' <?php echo ( _('event_recenter')) ?> '  title=' <?php echo ( _('event_recenter')) ?>' maxlength = '3' />
										</div>
									</div>
								</div>
								<div class='col-md-3 col-sm-6 col-xs-12 1241219023975c06a7b67cd2f562fb9c'>
									<div class='item form-group'>
										<div class='col-xs-12'>
											<small class='text-muted'><?php echo ( _('event_box_bolide')) ?> <span class='required'>*</span></small>
											<input type = 'text' name='event_box_bolide' required='required' class='form-control col-md-7 col-xs-12 input-disabled' placeholder=' <?php echo ( _('event_box_bolide')) ?> '  title=' <?php echo ( _('event_box_bolide')) ?> '/>
										</div>
									</div>
								</div>
								<div class='col-md-3 col-sm-6 col-xs-12 d8e0b609204c974fb6dcf8ef684e109e'>
									<div class='item form-group'>
										<div class='col-xs-12'>
											<small class='text-muted'><?php echo ( _('event_model_psf')) ?> <span class='required'>*</span></small>
											<input type = 'text' name='event_model_psf' required='required' class='form-control col-md-7 col-xs-12 input-disabled' placeholder=' <?php echo ( _('event_model_psf')) ?> '  title=' <?php echo ( _('event_model_psf')) ?>' maxlength = '30' />
										</div>
									</div>
								</div>
								<div class='col-md-3 col-sm-6 col-xs-12 bb8df86ef619c9b9d7af3e8e152f307c'>
									<div class='item form-group'>
										<div class='col-xs-12'>
											<small class='text-muted'><?php echo ( _('event_model_bar')) ?> <span class='required'>*</span></small>
											<input type = 'text' name='event_model_bar' required='required' class='form-control col-md-7 col-xs-12 input-disabled' placeholder=' <?php echo ( _('event_model_bar')) ?> '  title=' <?php echo ( _('event_model_bar')) ?>' maxlength = '30' />
										</div>
									</div>
								</div>
								<div class='col-md-3 col-sm-6 col-xs-12 d6552b1fd85cccdfff17030c4eaa9ce5'>
									<div class='item form-group'>
										<div class='col-xs-12'>
											<small class='text-muted'><?php echo ( _('event_report')) ?> <span class='required'>*</span></small>
											<input type = 'text' name='event_report' required='required' class='form-control col-md-7 col-xs-12 input-disabled' placeholder=' <?php echo ( _('event_report')) ?> '  title=' <?php echo ( _('event_report')) ?>' maxlength = '3' />
										</div>
									</div>
								</div>
								<div class='col-md-3 col-sm-6 col-xs-12 921dd7749221705bfe2f5899333b836b'>
									<div class='item form-group'>
										<div class='col-xs-12'>
											<small class='text-muted'><?php echo ( _('event_image')) ?> <span class='required'>*</span></small>
											<input type = 'text' name='event_image' required='required' class='form-control col-md-7 col-xs-12 input-disabled' placeholder=' <?php echo ( _('event_image')) ?> '  title=' <?php echo ( _('event_image')) ?>' maxlength = '3' />
										</div>
									</div>
								</div>
								<div class='col-md-3 col-sm-6 col-xs-12 05cf6a760b8a736fa094e18d9d024509'>
									<div class='item form-group'>
										<div class='col-xs-12'>
											<small class='text-muted'><?php echo ( _('event_video')) ?> <span class='required'>*</span></small>
											<input type = 'text' name='event_video' required='required' class='form-control col-md-7 col-xs-12 input-disabled' placeholder=' <?php echo ( _('event_video')) ?> '  title=' <?php echo ( _('event_video')) ?>' maxlength = '3' />
										</div>
									</div>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<?php include './view/template/foot.php'; ?>
	<script src='<?php echo $_SERVER['PATH_WEBROOT'] ?>/js/configParameters.js<?= _VERSION_ ?>'></script>

