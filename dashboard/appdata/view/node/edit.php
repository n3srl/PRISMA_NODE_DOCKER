<?php /* @var $Node Node */ ?>
<div class='right_col' role='main'>
  <div class=''>
    <div class='page-title'>
      <div class='title_left'>
        <h2><?= _('Node') ?></h2>
      </div>
    </div>
    <div class='clearfix'></div>
    <div class='row'>
      <div class='col-md-12 col-sm-12 col-xs-12'>
        <div id='list' class='x_panel'>
          <div class='x_title no-padding-lr'>
            <div class='clearfix'>
              <div class='col-md-6 no-padding-l'>
                <h2><?= _('Lista Nodi') ?></h2>
              </div>
              <div class='col-md-6 no-padding'>
                <a href='#edit'><button type='button' onclick='newObj()' style='margin-right: 10px' class='btn btn-success pull-right'><?= _('AGGIUNGI NUOVO NODO') ?></button></a>
              </div>
              <div class='col-md-12 no-padding'>
                <a href='#editPerson'><button type='button' onclick='newPerson()' style='margin-right: 10px' class='btn btn-success pull-right'><?= _('AGGIUNGI NUOVO CONTATTO') ?></button></a>
              </div>
              <div class='col-md-12 no-padding'>
                <button type='button' onclick='exportSolutionsFile()' style='margin-right: 10px' class='btn btn-success pull-right'><?= _('ESPORTA SOLUTIONS.ini') ?></button>
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
                    <small class='text-muted'><?php echo (_('station code')) ?></small>
                    <select class='form-control filter filter-text' id='F_code' multiple='multiple' title='<?php echo (_('Filtra per code')) ?>'>
                    </select>
                  </div>
                </div>
              </div>
              <div class='form-group col-md-3 col-sm-6 col-xs-12 9ed39e2ea931586b6a985a6942ef573e'>
                <div class='form-group'>
                  <div class='col-xs-12'>
                    <small class='text-muted'><?php echo (_('station name')) ?></small>
                    <select class='form-control filter filter-text' id='F_nickname' multiple='multiple' title='<?php echo (_('Filtra per nickname')) ?>'>
                    </select>
                  </div>
                </div>
              </div>
              <div class='form-group col-md-3 col-sm-6 col-xs-12 c13367945d5d4c91047b3b50234aa7ab'>
                <div class='form-group'>
                  <div class='col-xs-12'>
                    <small class='text-muted'><?php echo (_('region_id')) ?></small>
                    <select class='form-control filter filter-text' id='F_region_id' multiple='multiple' title='<?php echo (_('Filtra per region_id')) ?>'>
                    </select>
                  </div>
                </div>
              </div>
              <div class='form-group col-md-3 col-sm-6 col-xs-12 c13367945d5d4c91047b3b50234aa7ab'>
                <div class='form-group'>
                  <div class='col-xs-12'>
                    <small class='text-muted'><?php echo (_('IPaddress')) ?></small>
                    <select class='form-control filter filter-text' id='F_IPaddress' multiple='multiple' title='<?php echo (_('Filtra per IPaddress')) ?>'>
                    </select>
                  </div>
                </div>
              </div>
              <div class='form-group col-md-3 col-sm-6 col-xs-12 c13367945d5d4c91047b3b50234aa7ab'>
                <div class='form-group'>
                  <div class='col-xs-12'>
                    <small class='text-muted'><?php echo (_('refered_to')) ?></small>
                    <select class='form-control filter filter-text' id='F_refered_to' multiple='multiple' title='<?php echo (_('Filtra per refered_to')) ?>'>
                    </select>
                  </div>
                </div>
              </div>
              <div class='form-group col-md-3 col-sm-6 col-xs-12 b068931cc450442b63f5b3d276ea4297'>
                <div class='form-group'>
                  <div class='col-xs-12'>
                    <small class='text-muted'><?php echo (_('altitude')) ?></small>
                    <select class='form-control filter filter-text' id='F_altitude' multiple='multiple' title='<?php echo (_('Filtra per altitude')) ?>'>
                    </select>
                  </div>
                </div>
              </div>
              <div class='form-group col-md-3 col-sm-6 col-xs-12 b068931cc450442b63f5b3d276ea4297'>
                <div class='form-group'>
                  <div class='col-xs-12'>
                    <small class='text-muted'><?php echo (_('longitude')) ?></small>
                    <select class='form-control filter filter-text' id='F_longitude' multiple='multiple' title='<?php echo (_('Filtra per longitude')) ?>'>
                    </select>
                  </div>
                </div>
              </div>
              <div class='form-group col-md-3 col-sm-6 col-xs-12 b068931cc450442b63f5b3d276ea4297'>
                <div class='form-group'>
                  <div class='col-xs-12'>
                    <small class='text-muted'><?php echo (_('latitude')) ?></small>
                    <select class='form-control filter filter-text' id='F_latitude' multiple='multiple' title='<?php echo (_('Filtra per latitude')) ?>'>
                    </select>
                  </div>
                </div>
              </div>
              <div class='form-group col-md-3 col-sm-6 col-xs-12 b068931cc450442b63f5b3d276ea4297'>
                <div class='form-group'>
                  <div class='col-xs-12'>
                    <small class='text-muted'><?php echo (_('note')) ?></small>
                    <select class='form-control filter filter-text' id='F_note' multiple='multiple' title='<?php echo (_('Filtra per note')) ?>'>
                    </select>
                  </div>
                </div>
              </div>
              <div class='form-group col-md-3 col-sm-6 col-xs-12 b068931cc450442b63f5b3d276ea4297'>
                <div class='form-group'>
                  <div class='col-xs-12'>
                    <small class='text-muted'><?php echo (_('hostname')) ?></small>
                    <select class='form-control filter filter-text' id='F_hostname' multiple='multiple' title='<?php echo (_('Filtra per hostname')) ?>'>
                    </select>
                  </div>
                </div>
              </div>
              <div class='form-group col-md-3 col-sm-6 col-xs-12 b068931cc450442b63f5b3d276ea4297'>
                <div class='form-group'>
                  <div class='col-xs-12'>
                    <small class='text-muted'><?php echo (_('active')) ?></small>
                    <select class='form-control filter filter-text' id='F_active' multiple='multiple' title='<?php echo (_('Filtra per active')) ?>'>
                    </select>
                  </div>
                </div>
              </div>
              <div class='form-group col-md-3 col-sm-6 col-xs-12 b068931cc450442b63f5b3d276ea4297'>
                <div class='form-group'>
                  <div class='col-xs-12'>
                    <small class='text-muted'><?php echo (_('nameof_company_association')) ?></small>
                    <select class='form-control filter filter-text' id='F_nameof_company-association' multiple='multiple' title='<?php echo (_('Filtra per nameof_company_association')) ?>'>
                    </select>
                  </div>
                </div>
              </div>

              <div class='form-group col-md-12 col-sm-12 col-xs-12'>
                <div class='form-group'>
                  <div class='col-xs-12'>
                    <button class="pull-right btn btn-success applyFilter"><?= _("Applica filtri") ?></button>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class='x_content'>
            <table id='NodeList' class='table table-striped table-bordered' style='width: 100%;'>
              <thead>
                <tr>
                  <th><?php echo (_('Station Code')) ?></th>
                  <th><?php echo (_('Station Name')) ?></th>
                  <th><?php echo (_('Region ID')) ?></th>
                  <th><?php echo (_('IP address')) ?></th>
                  <th style="display: none"><?php echo (_('Refered to')) ?></th>
                  <th><?php echo (_('Altitude')) ?></th>
                  <th><?php echo (_('Longitude')) ?></th>
                  <th><?php echo (_('Latitude')) ?></th>
                  <th><?php echo (_('Note')) ?></th>
                  <th><?php echo (_('Hostname')) ?></th>
                  <th><?php echo (_('Active')) ?></th>
                  <th><?php echo (_('Name of company/association')) ?></th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
          </div>

          <div class='x_content'>
            <table id='CorePersonList' class='table table-striped table-bordered' style='width: 100%;'>
              <thead>
                <tr>
                  <th><?php echo (_('First name')) ?></th>
                  <th><?php echo (_('Middle name')) ?></th>
                  <th><?php echo (_('Last name')) ?></th>
                  <th><?php echo (_('Email')) ?></th>
                  <th><?php echo (_('Phone')) ?></th>
                  <th><?php echo (_('Name of company/association')) ?></th>
                  <th><?php echo (_('Address')) ?></th>
                  <th><?php echo (_('Postcode')) ?></th>
                  <th><?php echo (_('City')) ?></th>
                  <th><?php echo (_('Province')) ?></th>
                  <th><?php echo (_('Country')) ?></th>
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
        <form id='CompanyForm' method='POST' action='/service/node/save/<?php echo $Node->id; ?>' class='form-horizontal form-label-left' novalidate>
          <div id='edit' class='x_panel'>
            <div class='x_title no-padding-lr'>
              <div class='clearfix'>
                <div class='col-md-8 no-padding'>
                  <h2><?= _('Aggiungi nuovo') ?></h2>
                </div>
                <div class='col-md-4 no-padding'>
                  <button type='button' style='display: none; margin-right: 10px;' id='deletebtn' class='btn btn-danger pull-right' onclick="removeObj()"><?= _('ELIMINA') ?></button>
                  <button type='submit' style='display: none; margin-right: 10px;' id='savebtn' class='btn btn-success pull-right'><?= _('SALVA') ?></button>
                  <button type='button' style='display: none; margin-right: 10px;' id='cleanbtn' onclick='newObj()' class='btn btn-clean pull-right cleanForm'><?= _('PULISCI CAMPI') ?></button>
                  <button type='button' style='display: none; margin-right: 10px;' id='modifybtn' onclick='allowEditObj();' class='btn btn-success btn-blue-success pull-right'><?= _('MODIFICA') ?></button>
                  <button type='button' style='display: none; margin-right: 10px;' id='undobtn' onclick='undoObj();' class='btn btn-warning btn-yellow-warning pull-right'><?= _('ANNULLA') ?></button>
                  <a href='#list'><button type='button' style='margin-right: 10px' class='btn btn-all pull-right'><?= _('TUTTI') ?></button></a>
                </div>
              </div>
            </div>
            <div class='x_content'>
              <div class='col-md-12 col-sm-12 col-xs-12'>
                <div class='item form-group'>
                  <label class='col-md-6 col-sm-6 col-xs-12'><?= _('I campi contrassegnati con * sono obbligatori') ?></label>
                </div>
              </div>

              <div class='col-md-3 col-sm-6 col-xs-12 b80bb7740288fda1f201890375a60c8f' hidden>
                <div class='item form-group'>
                  <div class='col-xs-12'>
                    <small class='text-muted'><?php echo (_('id')) ?> </small>
                    <input type='text' id='id' name='id' class='form-control col-md-7 col-xs-12 input-disabled' placeholder=' <?php echo (_('id')) ?> ' title=' <?php echo (_('id')) ?> ' />
                  </div>
                </div>
              </div>
              <div class='col-md-3 col-sm-6 col-xs-12 0f442f9609e5d4cc945234896246cce7'>
                <div class='item form-group'>
                  <div class='col-xs-12'>
                    <small class='text-muted'><?php echo (_('Region ID')) ?> <span class='required'>*</span></small>
                    <select name='region_id' required='required' id='region_id' class='form-control col-md-7 col-xs-12 input-disabled region_name' title=' <?php echo (_('region_id')) ?>'>
                    </select>

                  </div>
                </div>

              </div>
              <div class='col-md-3 col-sm-6 col-xs-12 c13367945d5d4c91047b3b50234aa7ab'>
                <div class='item form-group'>
                  <div class='col-xs-12'>
                    <small class='text-muted'><?php echo (_('Station Code')) ?> </small>
                    <input type='text' id='code' name='code' class='form-control col-md-7 col-xs-12 input-disabled' placeholder=' <?php echo (_('station_code')) ?> ' title=' <?php echo (_('code')) ?>' maxlength='8' />
                  </div>
                </div>
              </div>
              <div class='col-md-3 col-sm-6 col-xs-12 c13367945d5d4c91047b3b50234aa7ab'>
                <div class='item form-group'>
                  <div class='col-xs-12'>
                    <small class='text-muted'><?php echo (_('Station Name')) ?> </small>
                    <input type='text' name='nickname' class='form-control col-md-7 col-xs-12 input-disabled' placeholder=' <?php echo (_('station_name')) ?> ' title=' <?php echo (_('nickname')) ?>' maxlength='100' />
                  </div>
                </div>
              </div>
              <div class='col-md-3 col-sm-6 col-xs-12 5ecbd4888907c51253c96a04adeaf7e9'>
                <div class='item form-group'>
                  <div class='col-xs-12'>
                    <small class='text-muted'><?php echo (_('IP Address')) ?></small>
                    <input type='text' name='IPaddress' class='form-control col-md-7 col-xs-12 input-disabled' placeholder=' <?php echo (_('IP address')) ?> ' title=' <?php echo (_('IPaddress')) ?>' maxlength='45' />
                  </div>
                </div>
              </div>

              <div class='col-md-3 col-sm-6 col-xs-12 0f442f9609e5d4cc945234896246cce7'>
                <div class='item form-group'>
                  <div class='col-xs-12'>
                    <small class='text-muted'><?php echo (_('Refered to')) ?> <span class='required'>*</span></small>
                    <select name='refered_to' id='refered_to' class='form-control col-md-7 col-xs-12 input-disabled refered_to_name' title=' <?php echo (_('refered_to')) ?>'>
                    </select>

                  </div>
                </div>
              </div>


              <div class='col-md-3 col-sm-6 col-xs-12 14d893303d2d61e5965e96e2c9fe3bfa'>
                <div class='item form-group'>
                  <div class='col-xs-12'>
                    <small class='text-muted'><?php echo (_('Altitude')) ?></small>
                    <input type='text' name='altitude' class='form-control col-md-7 col-xs-12 input-disabled' placeholder=' <?php echo (_('altitude')) ?> ' title=' <?php echo (_('altitude')) ?>' maxlength='100' />
                  </div>
                </div>
              </div>
              <div class='col-md-3 col-sm-6 col-xs-12 ba569b80f7bb7762f073f1be57cc36aa'>
                <div class='item form-group'>
                  <div class='col-xs-12'>
                    <small class='text-muted'><?php echo (_('Longitude')) ?></small>
                    <input type='text' name='longitude' class='form-control col-md-7 col-xs-12 input-disabled' placeholder=' <?php echo (_('longitude')) ?> ' title=' <?php echo (_('longitude')) ?>' maxlength='13' />
                  </div>
                </div>
              </div>
              <div class='col-md-3 col-sm-6 col-xs-12 28c1e37e317b935a387dbe232bc9f803'>
                <div class='item form-group'>
                  <div class='col-xs-12'>
                    <small class='text-muted'><?php echo (_('Latitude')) ?></small>
                    <input type='text' name='latitude' class='form-control col-md-7 col-xs-12 input-disabled' placeholder=' <?php echo (_('latitude')) ?> ' title=' <?php echo (_('latitude')) ?>' maxlength='13' />
                  </div>
                </div>
              </div>
              <div class='col-md-3 col-sm-6 col-xs-12 aad653ca3ee669635f2938b73098b6d7'>
                <div class='item form-group'>
                  <div class='col-xs-12'>
                    <small class='text-muted'><?php echo (_('Note')) ?></small>
                    <input type='text' name='note' id='note' class='form-control col-md-7 col-xs-12 input-disabled' placeholder=' <?php echo (_('note')) ?> ' title=' <?php echo (_('note')) ?>' />
                  </div>
                </div>
              </div>
              <div class='col-md-3 col-sm-6 col-xs-12 0897acf49c7c1ea9f76efe59187aa046'>
                <div class='item form-group'>
                  <div class='col-xs-12'>
                    <small class='text-muted'><?php echo (_('Hostname')) ?></small>
                    <input type='text' name='hostname' id='hostname' class='form-control col-md-7 col-xs-12 input-disabled' placeholder=' <?php echo (_('hostname')) ?> ' title=' <?php echo (_('hostname')) ?>' maxlength='100' />
                  </div>
                </div>
              </div>
              <div class='col-md-3 col-sm-6 col-xs-12 c76a5e84e4bdee527e274ea30c680d79'>
                <div class='item form-group'>
                  <div class='col-xs-12'>
                    <small class='text-muted'><?php echo (_('Active')) ?></small>
                    <select type='text' name='active' class='form-control col-md-7 col-xs-12 input-disabled nodestatusForm' title=' <?php echo (_('active')) ?>'></select>
                  </div>
                </div>
              </div>
              <div class='col-md-3 col-sm-6 col-xs-12 505defc2e0e8e7900247e3e62ef9ae1d'>
                <div class='item form-group'>
                  <div class='col-xs-12'>
                    <small class='text-muted'><?php echo (_('Name of company association')) ?></small>
                    <input type='text' name='nameof_company_association' class='form-control col-md-7 col-xs-12 input-disabled' placeholder=' <?php echo (_('nameof_company_association')) ?> ' title=' <?php echo (_('nameof_company_association')) ?>' />
                  </div>
                </div>
              </div>
              <div class='col-md-3 col-sm-6 col-xs-12 0f01f2b9626a9cf174182b3d9b94ad9c'>
                <div class='item form-group'>
                  <div class='col-xs-12'>
                    <small class='text-muted'><?php echo (_('Camera model')) ?></small>
                    <select id = 'camera_model' name = 'camera_model' class='form-control col-md-7 col-xs-12 input-disabled camera_model'>
                      
                    </select>
                    </div>
                </div>
              </div>
              <div class='col-md-3 col-sm-6 col-xs-12 0f01f2b9626a9cf174182b3d9b94ad9c'>
                <div class='item form-group'>
                  <div class='col-xs-12'>
                    <small class='text-muted'><?php echo (_('Focal length')) ?></small>
                    <input type='text' name='focal_length' id='focal_length' class='form-control col-md-7 col-xs-12 input-disabled' placeholder=' <?php echo (_('focal_length')) ?> ' title=' <?php echo (_('focal-length')) ?>' />
                  </div>
                </div>
              </div>
              <div class='col-md-3 col-sm-6 col-xs-12 0f01f2b9626a9cf174182b3d9b94ad9c'>
                <div class='item form-group'>
                  <div class='col-xs-12'>
                    <small class='text-muted'><?php echo (_('Node version')) ?></small>
                    
                    <select id = 'node_version' name = 'node_version' class='form-control col-md-7 col-xs-12 input-disabled node_version'>
                      
                    </select>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </form>

        <form id='PersonForm' method='POST' action='/service/person/save/<?php echo $Person->id; ?>' class='form-horizontal form-label-left' novalidate>
          <div id='editPerson' class='x_panel'>
            <div class='x_title no-padding-lr'>
              <div class='clearfix'>
                <div class='col-md-8 no-padding'>
                  <h2><?= _('Aggiungi nuovo') ?></h2>
                </div>
                <div class='col-md-4 no-padding'>
                  <button type='button' style='display: none; margin-right: 10px;' id='deletebtnPerson' class='btn btn-danger pull-right' onclick="removePerson()"><?= _('ELIMINA') ?></button>
                  <button type='submit' style='display: none; margin-right: 10px;' id='savebtnPerson' class='btn btn-success pull-right'><?= _('SALVA') ?></button>
                  <button type='button' style='display: none; margin-right: 10px;' id='cleanbtnPerson' onclick='newPerson()' class='btn btn-clean pull-right cleanForm'><?= _('PULISCI CAMPI') ?></button>
                  <button type='button' style='display: none; margin-right: 10px;' id='modifybtnPerson' onclick='allowEditPerson();' class='btn btn-success btn-blue-success pull-right'><?= _('MODIFICA') ?></button>
                  <button type='button' style='display: none; margin-right: 10px;' id='undobtnPerson' onclick='undoPerson();' class='btn btn-warning btn-yellow-warning pull-right'><?= _('ANNULLA') ?></button>
                  <a href='#list'><button type='button' style='margin-right: 10px' class='btn btn-all pull-right'><?= _('TUTTI') ?></button></a>
                </div>
              </div>
            </div>
            <div class='x_content'>
              <div class='col-md-12 col-sm-12 col-xs-12'>
                <div class='item form-group'>
                  <label class='col-md-6 col-sm-6 col-xs-12'><?= _('I campi contrassegnati con * sono obbligatori') ?></label>
                </div>
              </div>



              <div class='col-md-3 col-sm-6 col-xs-12 a8452ca7c1312f959e1307fe2d017eb0' hidden>
                <div class='item form-group'>
                  <div class='col-xs-12'>
                    <small class='text-muted'><?php echo (_('id')) ?> </small>
                    <input type='text' name='idPerson' class='form-control col-md-7 col-xs-12 input-disabled' placeholder=' <?php echo (_('id')) ?> ' title=' <?php echo (_('id')) ?> ' />
                  </div>
                </div>
              </div>
              <div class='col-md-3 col-sm-6 col-xs-12 14c4b06b824ec593239362517f538b29' hidden>
                <div class='item form-group'>
                  <div class='col-xs-12'>
                    <small class='text-muted'><?php echo (_('Username')) ?> <span class='required'>*</span></small>
                    <input type='text' name='username' required='required' id='username' class='form-control col-md-7 col-xs-12 input-disabled' placeholder=' <?php echo (_('username')) ?> ' title=' <?php echo (_('username')) ?>'>
                    </input>

                  </div>
                </div>
              </div>

              <div class='col-md-3 col-sm-6 col-xs-12 2a034e9d9e2601c21191cca53760eaaf'>
                <div class='item form-group'>
                  <div class='col-xs-12'>
                    <small class='text-muted'><?php echo (_('First name')) ?></small>
                    <input type='text' name='first_name' class='form-control col-md-7 col-xs-12 input-disabled' placeholder=' <?php echo (_('first name')) ?> ' title=' <?php echo (_('first name')) ?>' maxlength='45' />
                  </div>
                </div>
              </div>
              <div class='col-md-3 col-sm-6 col-xs-12 e2e657fbf2b8662e5c235b568646a061'>
                <div class='item form-group'>
                  <div class='col-xs-12'>
                    <small class='text-muted'><?php echo (_('Middle name')) ?></small>
                    <input type='text' name='middle_name' class='form-control col-md-7 col-xs-12 input-disabled' placeholder=' <?php echo (_('middle name')) ?> ' title=' <?php echo (_('middle name')) ?>' />
                  </div>
                </div>
              </div>
              <div class='col-md-3 col-sm-6 col-xs-12 7d4553c09a59578c8addc8c617a76ca1'>
                <div class='item form-group'>
                  <div class='col-xs-12'>
                    <small class='text-muted'><?php echo (_('Last name')) ?></small>
                    <input type='text' name='last_name' class='form-control col-md-7 col-xs-12 input-disabled' placeholder=' <?php echo (_('last name')) ?> ' title=' <?php echo (_('last name')) ?>' maxlength='100' />
                  </div>
                </div>
              </div>
              <div class='col-md-3 col-sm-6 col-xs-12 0c83f57c786a0b4a39efab23731c7ebc'>
                <div class='item form-group'>
                  <div class='col-xs-12'>
                    <small class='text-muted'><?php echo (_('Email')) ?> </small>
                    <input type='text' name='email' class='form-control col-md-7 col-xs-12 input-disabled' placeholder=' <?php echo (_('email')) ?> ' title=' <?php echo (_('email')) ?>' />
                  </div>
                </div>
              </div>

              <div class='col-md-3 col-sm-6 col-xs-12 f7a42fe7211f98ac7a60a285ac3a9e87'>
                <div class='item form-group'>
                  <div class='col-xs-12'>
                    <small class='text-muted'><?php echo (_('Phone')) ?></small>
                    <input type='text' name='phone' class='form-control col-md-7 col-xs-12 input-disabled' placeholder=' <?php echo (_('phone')) ?> ' title=' <?php echo (_('phone')) ?>' maxlength='100' />
                  </div>
                </div>
              </div>
              <div class='col-md-3 col-sm-6 col-xs-12 99a5dfee45063b2e47edd1177b95b500'>
                <div class='item form-group'>
                  <div class='col-xs-12'>
                    <small class='text-muted'><?php echo (_('Address')) ?></small>
                    <input type='text' name='addressPerson' class='form-control col-md-7 col-xs-12 input-disabled' placeholder=' <?php echo (_('address')) ?> ' title=' <?php echo (_('address')) ?>' maxlength='100' />
                  </div>
                </div>
              </div>
              <div class='col-md-3 col-sm-6 col-xs-12 0ad30de1d12071b9d55f9a29282b3f32'>
                <div class='item form-group'>
                  <div class='col-xs-12'>
                    <small class='text-muted'><?php echo (_('Postcode')) ?></small>
                    <input type='text' name='postcodePerson' class='form-control col-md-7 col-xs-12 input-disabled' placeholder=' <?php echo (_('postcode')) ?> ' title=' <?php echo (_('postcode')) ?>' maxlength='100' />
                  </div>
                </div>
              </div>
              <div class='col-md-3 col-sm-6 col-xs-12 6ac75f3bb967c3f06cb826a5622f8d28'>
                <div class='item form-group'>
                  <div class='col-xs-12'>
                    <small class='text-muted'><?php echo (_('City')) ?></small>
                    <input type='text' name='cityPerson' class='form-control col-md-7 col-xs-12 input-disabled' placeholder=' <?php echo (_('city')) ?> ' title=' <?php echo (_('city')) ?>' maxlength='100' />
                  </div>
                </div>
              </div>
              <div class='col-md-3 col-sm-6 col-xs-12 4e412d5b4ddc1407053807d0739d3625'>
                <div class='item form-group'>
                  <div class='col-xs-12'>
                    <small class='text-muted'><?php echo (_('Province')) ?></small>
                    <input type='text' name='provincePerson' class='form-control col-md-7 col-xs-12 input-disabled' placeholder=' <?php echo (_('province')) ?> ' title=' <?php echo (_('province')) ?>' maxlength='100' />
                  </div>
                </div>
              </div>
              <div class='col-md-3 col-sm-6 col-xs-12 68c680b729879a9437fd6ee4db839395'>
                <div class='item form-group'>
                  <div class='col-xs-12'>
                    <small class='text-muted'><?php echo (_('Country')) ?></small>
                    <input type='text' name='countryPerson' class='form-control col-md-7 col-xs-12 input-disabled' placeholder=' <?php echo (_('country')) ?> ' title=' <?php echo (_('country')) ?>' maxlength='100' />
                  </div>
                </div>
              </div>

              <div class='col-md-3 col-sm-6 col-xs-12 55b9fb22d536d87ffa157e5407447e5d' hidden>
                <div class='item form-group'>
                  <div class='col-xs-12'>
                    <label class='text-muted checkbox-label'><?php echo (_('Station referer')) ?></label>
                    <input type='checkbox' id="is_station_referer" onclick="$(this).val(this.checked ? 1 : 0)" name='is_station_referer' class='col-md-1 col-xs-1 checkbox input-disabled' placeholder='<?php echo (_('is_station_referer')) ?>' title='<?php echo (_('is_station_referer')) ?>'>
                  </div>
                </div>
              </div>
              <div class='col-md-3 col-sm-6 col-xs-12 1b2a31ade2f7767e2525797735a21b61' hidden>
                <div class='item form-group'>
                  <div class='col-xs-12'>
                    <label class='text-muted checkbox-label'><?php echo (_('Administrator')) ?></label>
                    <input type='checkbox' id='is_administrator' name="is_administrator" class='col-md-1 col-xs-1 checkbox input-disabled' placeholder='<?php echo (_('is_administrator')) ?>' title='<?php echo (_('is_administrator')) ?>'>
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
<script src='<?php echo $_SERVER['PATH_WEBROOT'] ?>/js/node.js<?= _VERSION_ ?>'></script>