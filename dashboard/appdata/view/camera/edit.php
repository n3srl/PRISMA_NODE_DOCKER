<?php /* @var $Camera Camera */ ?> 
<div class='right_col' role='main'>
	<div class=''>
		<div class='page-title'>
			<div class='title_left'>
				<h2><?= _('Camera') ?></h2>
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
										<a href = '#edit' ><button type='button' onclick='newObj()' style='margin-right: 10px' class='btn btn-success pull-right' ><?= _('AGGIUNGI NUOVA CAMERA') ?></button></a>
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
								<div class='form-group col-md-3 col-sm-6 col-xs-12 c693ebc80e2b73b0d3bbece47c529399'>
									<div class='form-group'>
										<div class='col-xs-12'>
											<small class='text-muted'><?php echo (_('node_id')) ?></small>
											<select class='form-control filter filter-text' id='F_node_id' multiple='multiple' title='<?php echo (_('Filtra per node_id')) ?>'>
											</select>
										</div>
									</div>
								</div>
								<div class='form-group col-md-3 col-sm-6 col-xs-12 c13367945d5d4c91047b3b50234aa7ab'>
									<div class='form-group'>
										<div class='col-xs-12'>
											<small class='text-muted'><?php echo (_('code')) ?></small>
											<select class='form-control filter filter-text' id='F_code' multiple='multiple' title='<?php echo (_('Filtra per code')) ?>'>
											</select>
										</div>
									</div>
								</div>
								<div class='form-group col-md-3 col-sm-6 col-xs-12 5c8995e714cf9d777403916a2fa70e97'>
									<div class='form-group'>
										<div class='col-xs-12'>
											<small class='text-muted'><?php echo (_('config_file')) ?></small>
											<select class='form-control filter filter-text' id='F_config_file' multiple='multiple' title='<?php echo (_('Filtra per config_file')) ?>'>
											</select>
										</div>
									</div>
								</div>
								<div class='form-group col-md-3 col-sm-6 col-xs-12 e206779d3518b6f93e843561f058efc2'>
									<div class='form-group'>
										<div class='col-xs-12'>
											<small class='text-muted'><?php echo (_('mask_file')) ?></small>
											<select class='form-control filter filter-text' id='F_mask_file' multiple='multiple' title='<?php echo (_('Filtra per mask_file')) ?>'>
											</select>
										</div>
									</div>
								</div>
								<div class='form-group col-md-3 col-sm-6 col-xs-12 20f35e630daf44dbfa4c3f68f5399d8c'>
									<div class='form-group'>
										<div class='col-xs-12'>
											<small class='text-muted'><?php echo (_('model')) ?></small>
											<select class='form-control filter filter-text' id='F_model' multiple='multiple' title='<?php echo (_('Filtra per model')) ?>'>
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
								<table id='CameraList' class='table table-striped table-bordered' style='width: 100%; '>
									<thead>
									<tr>
										<th><?php echo (_('oid')) ?></th>
										<th><?php echo (_('node_id')) ?></th>
										<th><?php echo (_('code')) ?></th>
										<th><?php echo (_('config_file')) ?></th>
										<th><?php echo (_('mask_file')) ?></th>
										<th><?php echo (_('model')) ?></th>
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
					<form id='CompanyForm' method='POST' action='/service/camera/save/<?php echo $Camera->id;?>' class='form-horizontal form-label-left' novalidate>
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
								<div class='col-md-3 col-sm-6 col-xs-12 c693ebc80e2b73b0d3bbece47c529399'>
									<div class='item form-group'>
										<div class='col-xs-12'>
											<small class='text-muted'><?php echo ( _('node_id')) ?> <span class='required'>*</span></small>
											<select class='form-control foreign_key' id='node_id' name='node_id' multiple='multiple' required='required'  title='<?php echo(_('node_id')) ?>'>
											</select>
										</div>
									</div>
								</div>
								<div class='col-md-3 col-sm-6 col-xs-12 c13367945d5d4c91047b3b50234aa7ab'>
									<div class='item form-group'>
										<div class='col-xs-12'>
											<small class='text-muted'><?php echo ( _('code')) ?> </small>
											<input type = 'text' name='code' class='form-control col-md-7 col-xs-12 input-disabled' placeholder=' <?php echo ( _('code')) ?> '  title=' <?php echo ( _('code')) ?>' maxlength = '8' />
										</div>
									</div>
								</div>
								<div class='col-md-3 col-sm-6 col-xs-12 5c8995e714cf9d777403916a2fa70e97'>
									<div class='item form-group'>
										<div class='col-xs-12'>
											<small class='text-muted'><?php echo ( _('config_file')) ?> </small>
											<input type = 'text' name='config_file' class='form-control col-md-7 col-xs-12 input-disabled' placeholder=' <?php echo ( _('config_file')) ?> '  title=' <?php echo ( _('config_file')) ?>' maxlength = '100' />
										</div>
									</div>
								</div>
								<div class='col-md-3 col-sm-6 col-xs-12 e206779d3518b6f93e843561f058efc2'>
									<div class='item form-group'>
										<div class='col-xs-12'>
											<small class='text-muted'><?php echo ( _('mask_file')) ?> </small>
											<input type = 'text' name='mask_file' class='form-control col-md-7 col-xs-12 input-disabled' placeholder=' <?php echo ( _('mask_file')) ?> '  title=' <?php echo ( _('mask_file')) ?>' maxlength = '100' />
										</div>
									</div>
								</div>
								<div class='col-md-3 col-sm-6 col-xs-12 20f35e630daf44dbfa4c3f68f5399d8c'>
									<div class='item form-group'>
										<div class='col-xs-12'>
											<small class='text-muted'><?php echo ( _('model')) ?> </small>
											<input type = 'text' name='model' class='form-control col-md-7 col-xs-12 input-disabled' placeholder=' <?php echo ( _('model')) ?> '  title=' <?php echo ( _('model')) ?>' maxlength = '100' />
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
	<script src='<?php echo $_SERVER['PATH_WEBROOT'] ?>/js/camera.js<?= _VERSION_ ?>'></script>

