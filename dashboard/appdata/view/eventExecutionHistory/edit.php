<?php /* @var $EventExecutionHistory EventExecutionHistory */ ?> 
<div class='right_col' role='main'>
	<div class=''>
		<div class='page-title'>
			<div class='title_left'>
				<h2><?= _('EventExecutionHistory') ?></h2>
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
								<div class='form-group col-md-3 col-sm-6 col-xs-12 4437cfaca07febc397b36b521305be41'>
									<div class='form-group'>
										<div class='col-xs-12'>
											<small class='text-muted'><?php echo (_('event_id')) ?></small>
											<select class='form-control filter filter-text' id='F_event_id' multiple='multiple' title='<?php echo (_('Filtra per event_id')) ?>'>
											</select>
										</div>
									</div>
								</div>
								<div class='col-md-3 col-sm-6 col-xs-12 ea749f82dbba41b8215e6ec078a6ce91'>
									<div class='form-group'>
										<div class='col-xs-12'>
											<small class='text-muted'><?php echo (_('execution_datetime')) ?></small>
											<input type='text' autocomplete='off' class='form-control filter filter-date' id='F_execution_datetime' title='<?php echo (_('Filtra per execution_datetime')) ?>'>
										</div>
									</div>
								</div>
								<div class='form-group col-md-3 col-sm-6 col-xs-12 0c280714280b951abc66f5b8922b0e26'>
									<div class='form-group'>
										<div class='col-xs-12'>
											<small class='text-muted'><?php echo (_('config_parameters')) ?></small>
											<select class='form-control filter filter-text' id='F_config_parameters' multiple='multiple' title='<?php echo (_('Filtra per config_parameters')) ?>'>
											</select>
										</div>
									</div>
								</div>
								<div class='form-group col-md-3 col-sm-6 col-xs-12 64322f5f3ff7f9f717279e1b017a997e'>
									<div class='form-group'>
										<div class='col-xs-12'>
											<small class='text-muted'><?php echo (_('stdout')) ?></small>
											<select class='form-control filter filter-text' id='F_stdout' multiple='multiple' title='<?php echo (_('Filtra per stdout')) ?>'>
											</select>
										</div>
									</div>
								</div>
								<div class='form-group col-md-3 col-sm-6 col-xs-12 41be535153c4b535bc9d0a610d3bd66b'>
									<div class='form-group'>
										<div class='col-xs-12'>
											<small class='text-muted'><?php echo (_('stderr')) ?></small>
											<select class='form-control filter filter-text' id='F_stderr' multiple='multiple' title='<?php echo (_('Filtra per stderr')) ?>'>
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
								<table id='EventExecutionHistoryList' class='table table-striped table-bordered' style='width: 100%; '>
									<thead>
									<tr>
										<th><?php echo (_('oid')) ?></th>
										<th><?php echo (_('event_id')) ?></th>
										<th><?php echo (_('execution_datetime')) ?></th>
										<th><?php echo (_('config_parameters')) ?></th>
										<th><?php echo (_('stdout')) ?></th>
										<th><?php echo (_('stderr')) ?></th>
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
					<form id='CompanyForm' method='POST' action='/service/eventExecutionHistory/save/<?php echo $EventExecutionHistory->id;?>' class='form-horizontal form-label-left' novalidate>
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
								<div class='col-md-3 col-sm-6 col-xs-12 4437cfaca07febc397b36b521305be41'>
									<div class='item form-group'>
										<div class='col-xs-12'>
											<small class='text-muted'><?php echo ( _('event_id')) ?> <span class='required'>*</span></small>
											<select class='form-control foreign_key' id='event_id' name='event_id' multiple='multiple' required='required'  title='<?php echo(_('event_id')) ?>'>
											</select>
										</div>
									</div>
								</div>
								<div class='col-md-3 col-sm-6 col-xs-12 ea749f82dbba41b8215e6ec078a6ce91'>
									<div class='item form-group'>
										<div class='col-xs-12'>
											<small class='text-muted'><?php echo ( _('execution_datetime')) ?> <span class='required'>*</span></small>
											<input type = 'text' autocomplete='off' name='execution_datetime' required='required' class='date form-control col-md-7 col-xs-12 has-feedback-left input-disabled' date='date' placeholder='<?php echo ( _('execution_datetime')) ?>' title=<?php echo ( _('execution_datetime')) ?>/>
											<span class='fa fa-calendar-o form-control-feedback left' aria-hidden='true'></span>
										</div>
									</div>
								</div>
								<div class='col-md-3 col-sm-6 col-xs-12 0c280714280b951abc66f5b8922b0e26'>
									<div class='item form-group'>
										<div class='col-xs-12'>
											<small class='text-muted'><?php echo ( _('config_parameters')) ?> <span class='required'>*</span></small>
											<input type = 'text' name='config_parameters' required='required' class='form-control col-md-7 col-xs-12 input-disabled' placeholder=' <?php echo ( _('config_parameters')) ?> '  title=' <?php echo ( _('config_parameters')) ?>' maxlength = '200' />
										</div>
									</div>
								</div>
								<div class='col-md-3 col-sm-6 col-xs-12 64322f5f3ff7f9f717279e1b017a997e'>
									<div class='item form-group'>
										<div class='col-xs-12'>
											<small class='text-muted'><?php echo ( _('stdout')) ?> </small>
											<input type = 'text' name='stdout' class='form-control col-md-7 col-xs-12 input-disabled' placeholder=' <?php echo ( _('stdout')) ?> '  title=' <?php echo ( _('stdout')) ?>' maxlength = '200' />
										</div>
									</div>
								</div>
								<div class='col-md-3 col-sm-6 col-xs-12 41be535153c4b535bc9d0a610d3bd66b'>
									<div class='item form-group'>
										<div class='col-xs-12'>
											<small class='text-muted'><?php echo ( _('stderr')) ?> </small>
											<input type = 'text' name='stderr' class='form-control col-md-7 col-xs-12 input-disabled' placeholder=' <?php echo ( _('stderr')) ?> '  title=' <?php echo ( _('stderr')) ?>' maxlength = '200' />
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
	<script src='<?php echo $_SERVER['PATH_WEBROOT'] ?>/js/eventExecutionHistory.js<?= _VERSION_ ?>'></script>

