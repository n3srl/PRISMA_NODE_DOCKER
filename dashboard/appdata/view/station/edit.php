<?php /* @var $Station Station */ ?> 
<script src="ext_lib_fe/dropzone.js"></script>
<link rel="stylesheet" href="css/dropzone.css">

<div class='right_col' role='main'>
	<div class=''>
		<div class='page-title'>
			<div class='title_left'>
				<h2><?= _('Station') ?></h2>
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
										<a href = '#edit' ><button type='button' onclick='newObj()' style='margin-right: 10px' class='btn btn-success pull-right' ><?= _('AGGIUNGI NUOVA STAZIONE') ?></button></a>
										<a href = '#import' ><button type='button' onclick='importKML()' style='margin-right: 10px' class='btn btn-success pull-right' ><?= _('IMPORTA KML') ?></button></a>
										<a href = '#export' ><button type='button' onclick='exportKML()' style='margin-right: 10px' class='btn btn-success pull-right' ><?= _('ESPORTA KML') ?></button></a>
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
											<select class='form-control filter filter-text' id='F_oid' multiple='multiple' title='<?php echo (_('Filtra per id oggetto')) ?>'>
											</select>
										</div>
									</div>
								</div>
								<div class='form-group col-md-3 col-sm-6 col-xs-12 0f442f9609e5d4cc945234896246cce7'>
									<div class='form-group'>
										<div class='col-xs-12'>
											<small class='text-muted'><?php echo (_('region_id')) ?></small>
											<select class='form-control filter filter-text' id='F_region_id' multiple='multiple' title='<?php echo (_('Filtra per regione')) ?>'>
											</select>
										</div>
									</div>
								</div>
								<div class='form-group col-md-3 col-sm-6 col-xs-12 c13367945d5d4c91047b3b50234aa7ab'>
									<div class='form-group'>
										<div class='col-xs-12'>
											<small class='text-muted'><?php echo (_('code')) ?></small>
											<select class='form-control filter filter-text' id='F_code' multiple='multiple' title='<?php echo (_('Filtra per codice')) ?>'>
											</select>
										</div>
									</div>
								</div>
								<div class='form-group col-md-3 col-sm-6 col-xs-12 ca4485161c0ae50aebd00501bf2bb9b0'>
									<div class='form-group'>
										<div class='col-xs-12'>
											<small class='text-muted'><?php echo (_('sequence_number')) ?></small>
											<select class='form-control filter filter-text' id='F_sequence_number' multiple='multiple' title='<?php echo (_('Filtra per numero di sequenza')) ?>'>
											</select>
										</div>
									</div>
								</div>
								<div class='form-group col-md-3 col-sm-6 col-xs-12 14d893303d2d61e5965e96e2c9fe3bfa'>
									<div class='form-group'>
										<div class='col-xs-12'>
											<small class='text-muted'><?php echo (_('altitude')) ?></small>
											<select class='form-control filter filter-text' id='F_altitude' multiple='multiple' title='<?php echo (_('Filtra per altitudine')) ?>'>
											</select>
										</div>
									</div>
								</div>
								<div class='form-group col-md-3 col-sm-6 col-xs-12 ba569b80f7bb7762f073f1be57cc36aa'>
									<div class='form-group'>
										<div class='col-xs-12'>
											<small class='text-muted'><?php echo (_('longitude')) ?></small>
											<select class='form-control filter filter-text' id='F_longitude' multiple='multiple' title='<?php echo (_('Filtra per longitudine')) ?>'>
											</select>
										</div>
									</div>
								</div>
								<div class='form-group col-md-3 col-sm-6 col-xs-12 28c1e37e317b935a387dbe232bc9f803'>
									<div class='form-group'>
										<div class='col-xs-12'>
											<small class='text-muted'><?php echo (_('latitude')) ?></small>
											<select class='form-control filter filter-text' id='F_latitude' multiple='multiple' title='<?php echo (_('Filtra per latitudine')) ?>'>
											</select>
										</div>
									</div>
								</div>
								<div class='form-group col-md-3 col-sm-6 col-xs-12 aad653ca3ee669635f2938b73098b6d7'>
									<div class='form-group'>
										<div class='col-xs-12'>
											<small class='text-muted'><?php echo (_('note')) ?></small>
											<select class='form-control filter filter-text' id='F_note' multiple='multiple' title='<?php echo (_('Filtra per note')) ?>'>
											</select>
										</div>
									</div>
								</div>
								<div class='form-group col-md-3 col-sm-6 col-xs-12 e80674170aae03909a55625e9cc9cf97'>
									<div class='form-group'>
										<div class='col-xs-12'>
											<small class='text-muted'><?php echo (_('nickname')) ?></small>
											<select class='form-control filter filter-text' id='F_nickname' multiple='multiple' title='<?php echo (_('Filtra per nickname')) ?>'>
											</select>
										</div>
									</div>
								</div>
								<div class='col-md-3 col-sm-6 col-xs-12 78f79590fa9c6794cf91da567a62a0fb'>
									<div class='form-group'>
										<div class='col-xs-12'>
											<small class='text-muted'><?php echo (_('registration_date')) ?></small>
											<input type='text' autocomplete='off' class='form-control filter filter-date' id='F_registration_date' title='<?php echo (_('Filtra per data di registrazione')) ?>'>
										</div>
									</div>
								</div>
								<div class='col-md-3 col-sm-6 col-xs-12 c76a5e84e4bdee527e274ea30c680d79'>
									<div class='form-group'>
										<div class='col-xs-12'>
											<small class='text-muted'><?php echo (_('active')) ?></small>
											<select class='form-control filter filter-checkbox' id='F_active' title='<?php echo (_('Filtra per flag attivo')) ?>'>
												<option value=''></option>
												<option value='1'> <?php echo (_('Sì')) ?></option>
												<option value='0'> <?php echo (_('No')) ?></option>
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
								<table id='StationList' class='table table-striped table-bordered' style='width: 100%; '>
									<thead>
									<tr>
										<th><?php echo (_('oid')) ?></th>
										<th><?php echo (_('region_id')) ?></th>
										<th><?php echo (_('code')) ?></th>
										<th><?php echo (_('sequence_number')) ?></th>
										<th><?php echo (_('altitude')) ?></th>
										<th><?php echo (_('longitude')) ?></th>
										<th><?php echo (_('latitude')) ?></th>
										<th><?php echo (_('note')) ?></th>
										<th><?php echo (_('nickname')) ?></th>
										<th><?php echo (_('registration_date')) ?></th>
										<th><?php echo (_('active')) ?></th>
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
					<form id='CompanyForm' method='POST' action='/service/station/save/<?php echo $Station->id;?>' class='form-horizontal form-label-left' novalidate>
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
								<div class='col-md-3 col-sm-6 col-xs-12 0f442f9609e5d4cc945234896246cce7'>
									<div class='item form-group'>
										<div class='col-xs-12'>
											<small class='text-muted'><?php echo ( _('region_id')) ?> <span class='required'>*</span></small>
											<select class='form-control foreign_key' id='region_id' name='region_id' multiple='multiple' required='required'  title='<?php echo(_('region_id')) ?>'>
											</select>
										</div>
									</div>
								</div>
								<div class='col-md-3 col-sm-6 col-xs-12 c13367945d5d4c91047b3b50234aa7ab'>
									<div class='item form-group'>
										<div class='col-xs-12'>
											<small class='text-muted'><?php echo ( _('code')) ?> <span class='required'>*</span></small>
											<input type = 'text' name='code' required='required' class='form-control col-md-7 col-xs-12 input-disabled' placeholder=' <?php echo ( _('code')) ?> '  title=' <?php echo ( _('code')) ?>' maxlength = '8' />
										</div>
									</div>
								</div>
								<div class='col-md-3 col-sm-6 col-xs-12 ca4485161c0ae50aebd00501bf2bb9b0'>
									<div class='item form-group'>
										<div class='col-xs-12'>
											<small class='text-muted'><?php echo ( _('sequence_number')) ?> <span class='required'>*</span></small>
											<input type = 'text' name='sequence_number' required='required' class='form-control col-md-7 col-xs-12 input-disabled' placeholder=' <?php echo ( _('sequence_number')) ?> '  title=' <?php echo ( _('sequence_number')) ?>' maxlength = '3' />
										</div>
									</div>
								</div>
								<div class='col-md-3 col-sm-6 col-xs-12 14d893303d2d61e5965e96e2c9fe3bfa'>
									<div class='item form-group'>
										<div class='col-xs-12'>
											<small class='text-muted'><?php echo ( _('altitude')) ?> </small>
											<input type = 'text' name='altitude' class='form-control col-md-7 col-xs-12 input-disabled' placeholder=' <?php echo ( _('altitude')) ?> '  title=' <?php echo ( _('altitude')) ?>' maxlength = '100' />
										</div>
									</div>
								</div>
								<div class='col-md-3 col-sm-6 col-xs-12 ba569b80f7bb7762f073f1be57cc36aa'>
									<div class='item form-group'>
										<div class='col-xs-12'>
											<small class='text-muted'><?php echo ( _('longitude')) ?> </small>
											<input type = 'text' name='longitude' class='form-control col-md-7 col-xs-12 input-disabled' placeholder=' <?php echo ( _('longitude')) ?> '  title=' <?php echo ( _('longitude')) ?> '/>
										</div>
									</div>
								</div>
								<div class='col-md-3 col-sm-6 col-xs-12 28c1e37e317b935a387dbe232bc9f803'>
									<div class='item form-group'>
										<div class='col-xs-12'>
											<small class='text-muted'><?php echo ( _('latitude')) ?> </small>
											<input type = 'text' name='latitude' class='form-control col-md-7 col-xs-12 input-disabled' placeholder=' <?php echo ( _('latitude')) ?> '  title=' <?php echo ( _('latitude')) ?> '/>
										</div>
									</div>
								</div>
								<div class='col-md-3 col-sm-6 col-xs-12 aad653ca3ee669635f2938b73098b6d7'>
									<div class='item form-group'>
										<div class='col-xs-12'>
											<small class='text-muted'><?php echo ( _('note')) ?> </small>
											<input type = 'text' name='note' class='form-control col-md-7 col-xs-12 input-disabled' placeholder=' <?php echo ( _('note')) ?> '  title=' <?php echo ( _('note')) ?> '/>
										</div>
									</div>
								</div>
								<div class='col-md-3 col-sm-6 col-xs-12 e80674170aae03909a55625e9cc9cf97'>
									<div class='item form-group'>
										<div class='col-xs-12'>
											<small class='text-muted'><?php echo ( _('nickname')) ?> </small>
											<input type = 'text' name='nickname' class='form-control col-md-7 col-xs-12 input-disabled' placeholder=' <?php echo ( _('nickname')) ?> '  title=' <?php echo ( _('nickname')) ?>' maxlength = '100' />
										</div>
									</div>
								</div>
								<div class='col-md-3 col-sm-6 col-xs-12 78f79590fa9c6794cf91da567a62a0fb'>
									<div class='item form-group'>
										<div class='col-xs-12'>
											<small class='text-muted'><?php echo ( _('registration_date')) ?> </small>
											<input type = 'text' autocomplete='off' name='registration_date' class='form-control date col-md-7 col-xs-12 has-feedback-left input-disabled' date='date' placeholder='<?php echo ( _('registration_date')) ?>' title=<?php echo ( _('registration_date')) ?>/>
											<span class='fa fa-calendar-o form-control-feedback left' aria-hidden='true'></span>
										</div>
									</div>
								</div>
								<div class='col-md-3 col-sm-6 col-xs-12 c76a5e84e4bdee527e274ea30c680d79'>
									<div class='item form-group'>
										<div class='col-xs-12'>
											<label class='text-muted checkbox-label'><?php echo ( _('active')) ?></label>
											<input type = 'checkbox' onclick="$(this).val(this.checked ? 1 : 0)"  name='active' class='col-md-1 col-xs-1 checkbox input-disabled' placeholder='<?php echo ( _('active')) ?>' title='<?php echo ( _('active')) ?>'>
										</div>
									</div>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
    
    <div id ="kml_upload_form" style="display:none;margin: auto; position: absolute; top: 100px; left: 500px; bottom: 500px; right: 500px; background-color: #FFF; color: #000;z-index: 100 ">
            <div>
                <button onclick="hideKMLForm()">X</button>
            </div>
            <form action="/lib/prismaCore/1/station/googleMarkers/ImportKML" class="dropzone"></form>
    </div>
</div>

<?php include './view/template/foot.php'; ?>
<script src='<?php echo $_SERVER['PATH_WEBROOT'] ?>/js/station.js<?= _VERSION_ ?>'></script>