<?php /* @var $ObservedBy ObservedBy */ ?> 
<div class='right_col' role='main'>
	<div class=''>
		<div class='page-title'>
			<div class='title_left'>
				<h2><?= _('ObservedBy') ?></h2>
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
										<a href = '#edit' ><button type='button' onclick='newObj()' style='margin-right: 10px' class='btn btn-success pull-right' ><?= _('AGGIUNGI NUOVA OSSERVAZIONE EVENTO') ?></button></a>
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
								<div class='form-group col-md-3 col-sm-6 col-xs-12 4437cfaca07febc397b36b521305be41'>
									<div class='form-group'>
										<div class='col-xs-12'>
											<small class='text-muted'><?php echo (_('event_id')) ?></small>
											<select class='form-control filter filter-text' id='F_event_id' multiple='multiple' title='<?php echo (_('Filtra per event_id')) ?>'>
											</select>
										</div>
									</div>
								</div>
								<div class='form-group col-md-3 col-sm-6 col-xs-12 0f12f9f256efb3a3b83513b9f51384ef'>
									<div class='form-group'>
										<div class='col-xs-12'>
											<small class='text-muted'><?php echo (_('detection_id')) ?></small>
											<select class='form-control filter filter-text' id='F_detection_id' multiple='multiple' title='<?php echo (_('Filtra per detection_id')) ?>'>
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
								<table id='ObservedByList' class='table table-striped table-bordered' style='width: 100%; '>
									<thead>
									<tr>
										<th><?php echo (_('event_id')) ?></th>
										<th><?php echo (_('detection_id')) ?></th>
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
					<form id='CompanyForm' method='POST' action='/service/observedBy/save/<?php echo $ObservedBy->id;?>' class='form-horizontal form-label-left' novalidate>
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
								<div class='col-md-3 col-sm-6 col-xs-12 4437cfaca07febc397b36b521305be41'>
									<div class='item form-group'>
										<div class='col-xs-12'>
											<small class='text-muted'><?php echo ( _('event_id')) ?> <span class='required'>*</span></small>
											<select class='form-control foreign_key' id='event_id' name='event_id' multiple='multiple' required='required'  title='<?php echo(_('event_id')) ?>'>
											</select>
										</div>
									</div>
								</div>
								<div class='col-md-3 col-sm-6 col-xs-12 0f12f9f256efb3a3b83513b9f51384ef'>
									<div class='item form-group'>
										<div class='col-xs-12'>
											<small class='text-muted'><?php echo ( _('detection_id')) ?> <span class='required'>*</span></small>
											<select class='form-control foreign_key' id='detection_id' name='detection_id' multiple='multiple' required='required'  title='<?php echo(_('detection_id')) ?>'>
											</select>
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
	<script src='<?php echo $_SERVER['PATH_WEBROOT'] ?>/js/observedBy.js<?= _VERSION_ ?>'></script>

