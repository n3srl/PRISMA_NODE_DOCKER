<?php /* @var $Permission Permission */ ?> 
<div class='right_col' role='main'>
    <div class=''>
        <div class='page-title'>
            <div class='title_left'>
                <h2><?= _('Permission') ?></h2>
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
                                <a href = '#edit' ><button type='button' onclick='newObj()' style='margin-right: 10px' class='btn btn-success pull-right' ><?= _('AGGIUNGI NUOVO PERMESSO') ?></button></a>
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
                            <div class='form-group col-md-3 col-sm-6 col-xs-12 81d0631cb71109c8c44506ddfec990f6'>
                                <div class='form-group'>
                                    <div class='col-xs-12'>
                                        <small class='text-muted'><?php echo (_('ext_oid')) ?></small>
                                        <select class='form-control filter filter-text' id='F_ext_oid' multiple='multiple' title='<?php echo (_('Filtra per ext_oid')) ?>'>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class='form-group col-md-3 col-sm-6 col-xs-12 a8452ca7c1312f959e1307fe2d017eb0'>
                                <div class='form-group'>
                                    <div class='col-xs-12'>
                                        <small class='text-muted'><?php echo (_('person_id')) ?></small>
                                        <select class='form-control filter filter-text' id='F_person_id' multiple='multiple' title='<?php echo (_('Filtra per person_id')) ?>'>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class='form-group col-md-3 col-sm-6 col-xs-12 0e939a4ffd3aacd724dd3b50147b4353'>
                                <div class='form-group'>
                                    <div class='col-xs-12'>
                                        <small class='text-muted'><?php echo (_('group_id')) ?></small>
                                        <select class='form-control filter filter-text' id='F_group_id' multiple='multiple' title='<?php echo (_('Filtra per group_id')) ?>'>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class='col-md-3 col-sm-6 col-xs-12 ec0cd3cb91fe82b9501f62a528eb07a9'>
                                <div class='form-group'>
                                    <div class='col-xs-12'>
                                        <small class='text-muted'><?php echo (_('execute')) ?></small>
                                        <select class='form-control filter filter-checkbox' id='F_execute' title='<?php echo (_('Filtra per execute')) ?>'>
                                            <option value=''></option>
                                            <option value='1'> <?php echo (_('Sì')) ?></option>
                                            <option value='0'> <?php echo (_('No')) ?></option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class='col-md-3 col-sm-6 col-xs-12 ecae13117d6f0584c25a9da6c8f8415e'>
                                <div class='form-group'>
                                    <div class='col-xs-12'>
                                        <small class='text-muted'><?php echo (_('read')) ?></small>
                                        <select class='form-control filter filter-checkbox' id='F_read' title='<?php echo (_('Filtra per read')) ?>'>
                                            <option value=''></option>
                                            <option value='1'> <?php echo (_('Sì')) ?></option>
                                            <option value='0'> <?php echo (_('No')) ?></option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class='col-md-3 col-sm-6 col-xs-12 efb2a684e4afb7d55e6147fbe5a332ee'>
                                <div class='form-group'>
                                    <div class='col-xs-12'>
                                        <small class='text-muted'><?php echo (_('write')) ?></small>
                                        <select class='form-control filter filter-checkbox' id='F_write' title='<?php echo (_('Filtra per write')) ?>'>
                                            <option value=''></option>
                                            <option value='1'> <?php echo (_('Sì')) ?></option>
                                            <option value='0'> <?php echo (_('No')) ?></option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class='col-md-3 col-sm-6 col-xs-12 c76a5e84e4bdee527e274ea30c680d79'>
                                <div class='form-group'>
                                    <div class='col-xs-12'>
                                        <small class='text-muted'><?php echo (_('active')) ?></small>
                                        <select class='form-control filter filter-checkbox' id='F_active' title='<?php echo (_('Filtra per active')) ?>'>
                                            <option value=''></option>
                                            <option value='1'> <?php echo (_('Sì')) ?></option>
                                            <option value='0'> <?php echo (_('No')) ?></option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class='form-group col-md-3 col-sm-6 col-xs-12 14c4b06b824ec593239362517f538b29'>
                                <div class='form-group'>
                                    <div class='col-xs-12'>
                                        <small class='text-muted'><?php echo (_('username')) ?></small>
                                        <select class='form-control filter filter-text' id='F_username' multiple='multiple' title='<?php echo (_('Filtra per username')) ?>'>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class='form-group col-md-3 col-sm-6 col-xs-12 cffce994824327219b2404cef953e5eb'>
                                <div class='form-group'>
                                    <div class='col-xs-12'>
                                        <small class='text-muted'><?php echo (_('secret_token')) ?></small>
                                        <select class='form-control filter filter-text' id='F_secret_token' multiple='multiple' title='<?php echo (_('Filtra per secret_token')) ?>'>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class='form-group col-md-12 col-sm-12 col-xs-12'>
                                <div class='form-group'>
                                    <div class='col-xs-12'>
                                        <button style= 'margin-right: 10px;' class="pull-right btn btn-success btn-blue-success applyFilter" ><?= _("Applica filtri") ?></button>
                                        <button style= 'margin-right: 10px;' class="pull-right btn btn-warning btn-yellow-warning clearFilter" ><?= _("Pulisci filtri") ?></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class='x_content'>
                        <table id='PermissionList' class='table table-striped table-bordered' style='width: 100%; '>
                            <thead>
                                <tr>
                                    <th><?php echo (_('oid')) ?></th>
                                    <th><?php echo (_('ext_oid')) ?></th>
                                    <th><?php echo (_('person_id')) ?></th>
                                    <th><?php echo (_('group_id')) ?></th>
                                    <th><?php echo (_('execute')) ?></th>
                                    <th><?php echo (_('read')) ?></th>
                                    <th><?php echo (_('write')) ?></th>
                                    <th><?php echo (_('active')) ?></th>
                                    <th><?php echo (_('username')) ?></th>
                                    <th><?php echo (_('secret_token')) ?></th>
                                    <th></th>
                                    <th></th>
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
                <form id='CompanyForm' method='POST' action='/service/permission/save/<?php echo $Permission->id; ?>' class='form-horizontal form-label-left' novalidate>
                    <div id='edit' class='x_panel'>
                        <div class='x_title no-padding-lr'>
                            <div class='clearfix'>
                                <div class='col-md-8 no-padding'>
                                    <h2><?= _('Aggiungi nuovo') ?></h2>
                                </div>
                                <div class='col-md-4 no-padding'>
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
                            <div class='col-md-3 col-sm-6 col-xs-12 81d0631cb71109c8c44506ddfec990f6'>
                                <div class='item form-group'>
                                    <div class='col-xs-12'>
                                        <small class='text-muted'><?php echo ( _('ext_oid')) ?> </small>
                                        <input type = 'text' name='ext_oid' class='form-control col-md-7 col-xs-12 input-disabled' placeholder=' <?php echo ( _('ext_oid')) ?> '  title=' <?php echo ( _('ext_oid')) ?>' maxlength = '32' />
                                    </div>
                                </div>
                            </div>
                            <div class='col-md-3 col-sm-6 col-xs-12 a8452ca7c1312f959e1307fe2d017eb0'>
                                <div class='form-group'>
                                    <div class='col-xs-12'>
                                        <small class='text-muted'><?php echo ( _('person_id')) ?></small>
                                        <select class='form-control foreign_key' id='person_id' name='person_id' title='<?php echo(_('person_id')) ?>'>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class='col-md-3 col-sm-6 col-xs-12 0e939a4ffd3aacd724dd3b50147b4353'>
                                <div class='form-group'>
                                    <div class='col-xs-12'>
                                        <small class='text-muted'><?php echo ( _('group_id')) ?></small>
                                        <select class='form-control foreign_key' id='group_id' name='group_id' title='<?php echo(_('group_id')) ?>'>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class='col-md-3 col-sm-6 col-xs-12 ec0cd3cb91fe82b9501f62a528eb07a9'>
                                <div class='item form-group'>
                                    <div class='col-xs-12'>
                                        <input type = 'checkbox' onclick="$(this).val(this.checked ? 1 : 0)"  name='execute' required='required' class='col-md-1 col-xs-1 input-disabled' placeholder='<?php echo ( _('execute')) ?>' title='<?php echo ( _('execute')) ?>'>
                                        <small class='text-muted'><?php echo ( _('execute')) ?> <span class='required'>*</span></small>
                                    </div>
                                </div>
                            </div>
                            <div class='col-md-3 col-sm-6 col-xs-12 ecae13117d6f0584c25a9da6c8f8415e'>
                                <div class='item form-group'>
                                    <div class='col-xs-12'>
                                        <input type = 'checkbox' onclick="$(this).val(this.checked ? 1 : 0)"  name='read' required='required' class='col-md-1 col-xs-1 input-disabled' placeholder='<?php echo ( _('read')) ?>' title='<?php echo ( _('read')) ?>'>
                                        <small class='text-muted'><?php echo ( _('read')) ?> <span class='required'>*</span></small>
                                    </div>
                                </div>
                            </div>
                            <div class='col-md-3 col-sm-6 col-xs-12 efb2a684e4afb7d55e6147fbe5a332ee'>
                                <div class='item form-group'>
                                    <div class='col-xs-12'>
                                        <input type = 'checkbox' onclick="$(this).val(this.checked ? 1 : 0)"  name='write' required='required' class='col-md-1 col-xs-1 input-disabled' placeholder='<?php echo ( _('write')) ?>' title='<?php echo ( _('write')) ?>'>
                                        <small class='text-muted'><?php echo ( _('write')) ?> <span class='required'>*</span></small>
                                    </div>
                                </div>
                            </div>
                            <div class='col-md-3 col-sm-6 col-xs-12 c76a5e84e4bdee527e274ea30c680d79'>
                                <div class='item form-group'>
                                    <div class='col-xs-12'>
                                        <input type = 'checkbox' onclick="$(this).val(this.checked ? 1 : 0)"  name='active' required='required' class='col-md-1 col-xs-1 input-disabled' placeholder='<?php echo ( _('active')) ?>' title='<?php echo ( _('active')) ?>'>
                                        <small class='text-muted'><?php echo ( _('active')) ?> <span class='required'>*</span></small>
                                    </div>
                                </div>
                            </div>
                            <div class='col-md-3 col-sm-6 col-xs-12 14c4b06b824ec593239362517f538b29'>
                                <div class='item form-group'>
                                    <div class='col-xs-12'>
                                        <small class='text-muted'><?php echo ( _('username')) ?> </small>
                                        <input type = 'text' name='username' class='form-control col-md-7 col-xs-12 input-disabled' placeholder=' <?php echo ( _('username')) ?> '  title=' <?php echo ( _('username')) ?>' maxlength = '100' />
                                    </div>
                                </div>
                            </div>
                            <div class='col-md-3 col-sm-6 col-xs-12 cffce994824327219b2404cef953e5eb'>
                                <div class='item form-group'>
                                    <div class='col-xs-12'>
                                        <small class='text-muted'><?php echo ( _('secret_token')) ?> </small>
                                        <input type = 'text' name='secret_token' class='form-control col-md-7 col-xs-12 input-disabled' placeholder=' <?php echo ( _('secret_token')) ?> '  title=' <?php echo ( _('secret_token')) ?>' maxlength = '45' />
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
<script src='<?php echo $_SERVER['PATH_WEBROOT'] ?>/js/crud/action.js<?= _VERSION_ ?>'></script>
<script src='<?php echo $_SERVER['PATH_WEBROOT'] ?>/js/form.js<?= _VERSION_ ?>'></script>
<script src='<?php echo $_SERVER['PATH_WEBROOT'] ?>/js/model/permissionClass.js<?= _VERSION_ ?>'></script>
<script src='<?php echo $_SERVER['PATH_WEBROOT'] ?>/js/factory/permissionFactory.js<?= _VERSION_ ?>'></script>
<script src='<?php echo $_SERVER['PATH_WEBROOT'] ?>/js/permission.js<?= _VERSION_ ?>'></script>
<script src='<?php echo $_SERVER['PATH_WEBROOT'] ?>/js/logic/permissionLogic.js<?= _VERSION_ ?>'></script>

