<?php /* @var $CalibrationConfiguration CalibrationConfiguration */ ?>
<div class='right_col' role='main'>
  <div class=''>
    <div class='page-title'>
      <div class='title_left'>
        <h2><?= _('Configurazione Calibrazione') ?></h2>
      </div>
    </div>
    <div class='clearfix'></div>
    <div class='row'>
      <div class='col-md-12 col-sm-12 col-xs-12'>
        <div id='list' class='x_panel'>
          <div class='x_title no-padding-lr'>
            <div class='clearfix'>
              <div class='col-md-6 no-padding-l'>
                <h2><?= _('Configurazione') ?></h2>
              </div>
            </div>
          </div>
          <div class='x_content'>
            <table id='NodeList' class='table table-striped table-bordered' style='width: 100%;'>
              <thead>
                <tr>
                  <th><?php echo (_('Station Code')) ?></th>
                  <th><?php echo (_('Station Name')) ?></th>
                  <th><?php echo (_('Altitude')) ?></th>
                  <th><?php echo (_('Latitude')) ?></th>
                  <th><?php echo (_('Longitude')) ?></th>
                  <th><?php echo (_('Note')) ?></th>
                  <th><?php echo (_('Calibration')) ?></th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php include './view/template/foot.php'; ?>
<script src='<?php echo $_SERVER['PATH_WEBROOT'] ?>/js/calibrationConfiguration.js<?= _VERSION_ ?>'></script>