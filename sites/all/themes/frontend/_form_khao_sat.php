<?php if (isset($_GET['nid'])): ?>
  <?php $node = node_load($_GET['nid']) ?>
  <?php if ($node !== FALSE): ?>

    <div class="row">
      <div class="offset-lg-2 col-lg-8  col-12">
        <div class="card border-top-danger">
          <div class="card-header">
            <div class="card-title">
                <h3><?=$node->title?></h3>
            </div>
          </div>
          <div class="card-footer">
            <?=$node->field_mo_ta['und'][0]['value']?>
          </div>
        </div>
        <div class="card">
          <div class="card-header">
            <div class="card-title">
              <?=$node->title?>
            </div>
            <div class="">
              <?=$node->field_mo_ta['und'][0]['value']?>
            </div>
          </div>
          <div class="card-body">

          </div>
        </div>
      </div>
    </div>
  <?php else: ?>
    <div class="alert alert-warning p-1">Không tìm thấy khảo sát!</div>
  <?php endif; ?>
<?php else: ?>
  <div class="alert alert-warning p-1">Không tìm thấy khảo sát!</div>
<?php endif; ?>

