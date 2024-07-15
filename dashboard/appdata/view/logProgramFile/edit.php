<?php /* @var $LogProgramFile LogProgramFile */ ?> 
<div class='right_col' role='main'>
	<div class=''>
		<div class='page-title'>
			<div class='title_left'>
				<h2><?= _('LogProgramFile') ?></h2>
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
								<div class='col-md-3 col-sm-6 col-xs-12 d7e6d55ba379a13d08c25d15faf2a23b'>
									<div class='form-group'>
										<div class='col-xs-12'>
											<small class='text-muted'><?php echo (_('timestamp')) ?></small>
											<input type='text' autocomplete='off' class='form-control filter filter-date' id='F_timestamp' title='<?php echo (_('Filtra per timestamp')) ?>'>
										</div>
									</div>
								</div>
								<div class='form-group col-md-3 col-sm-6 col-xs-12 599dcce2998a6b40b1e38e8c6006cb0a'>
									<div class='form-group'>
										<div class='col-xs-12'>
											<small class='text-muted'><?php echo (_('type')) ?></small>
											<select class='form-control filter filter-text' id='F_type' multiple='multiple' title='<?php echo (_('Filtra per type')) ?>'>
											</select>
										</div>
									</div>
								</div>
								<div class='form-group col-md-3 col-sm-6 col-xs-12 c9e9a848920877e76685b2e4e76de38d'>
									<div class='form-group'>
										<div class='col-xs-12'>
											<small class='text-muted'><?php echo (_('level')) ?></small>
											<select class='form-control filter filter-text' id='F_level' multiple='multiple' title='<?php echo (_('Filtra per level')) ?>'>
											</select>
										</div>
									</div>
								</div>
								<div class='form-group col-md-3 col-sm-6 col-xs-12 1cb251ec0d568de6a929b520c4aed8d1'>
									<div class='form-group'>
										<div class='col-xs-12'>
											<small class='text-muted'><?php echo (_('text')) ?></small>
											<select class='form-control filter filter-text' id='F_text' multiple='multiple' title='<?php echo (_('Filtra per text')) ?>'>
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
								<table id='LogProgramFileList' class='table table-striped table-bordered' style='width: 100%; '>
									<thead>
									<tr>
										<th><?php echo (_('oid')) ?></th>
										<th><?php echo (_('timestamp')) ?></th>
										<th><?php echo (_('type')) ?></th>
										<th><?php echo (_('level')) ?></th>
										<th><?php echo (_('text')) ?></th>
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
					<form id='CompanyForm' method='POST' action='/service/logProgramFile/save/<?php echo $LogProgramFile->id;?>' class='form-horizontal form-label-left' novalidate>
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
								<div class='col-md-3 col-sm-6 col-xs-12 d7e6d55ba379a13d08c25d15faf2a23b'>
									<div class='item form-group'>
										<div class='col-xs-12'>
											<small class='text-muted'><?php echo ( _('timestamp')) ?> <span class='required'>*</span></small>
											<input type = 'text' autocomplete='off' name='timestamp' required='required' class='date form-control col-md-7 col-xs-12 has-feedback-left input-disabled' date='date' placeholder='<?php echo ( _('timestamp')) ?>' title=<?php echo ( _('timestamp')) ?>/>
											<span class='fa fa-calendar-o form-control-feedback left' aria-hidden='true'></span>
										</div>
									</div>
								</div>
								<div class='col-md-3 col-sm-6 col-xs-12 599dcce2998a6b40b1e38e8c6006cb0a'>
									<div class='item form-group'>
										<div class='col-xs-12'>
											<small class='text-muted'><?php echo ( _('type')) ?> <span class='required'>*</span></small>
											<input type = 'text' name='type' required='required' class='form-control col-md-7 col-xs-12 input-disabled' placeholder=' <?php echo ( _('type')) ?> '  title=' <?php echo ( _('type')) ?>' maxlength = '45' />
										</div>
									</div>
								</div>
								<div class='col-md-3 col-sm-6 col-xs-12 c9e9a848920877e76685b2e4e76de38d'>
									<div class='item form-group'>
										<div class='col-xs-12'>
											<small class='text-muted'><?php echo ( _('level')) ?> <span class='required'>*</span></small>
											<input type = 'text' name='level' required='required' class='form-control col-md-7 col-xs-12 input-disabled' placeholder=' <?php echo ( _('level')) ?> '  title=' <?php echo ( _('level')) ?> '/>
										</div>
									</div>
								</div>
								<div class='col-md-3 col-sm-6 col-xs-12 1cb251ec0d568de6a929b520c4aed8d1'>
									<div class='item form-group'>
										<div class='col-xs-12'>
											<small class='text-muted'><?php echo ( _('text')) ?> <span class='required'>*</span></small>
											<input type = 'text' name='text' required='required' class='form-control col-md-7 col-xs-12 input-disabled' placeholder=' <?php echo ( _('text')) ?> '  title=' <?php echo ( _('text')) ?> '/>
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
	<script src='<?php echo $_SERVER['PATH_WEBROOT'] ?>/js/logProgramFile.js<?= _VERSION_ ?>'></script>

