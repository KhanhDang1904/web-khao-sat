<!-- Bordered table start -->
<div class="row" id="table-bordered">
  <div class="col-12">
    <div class="card">
      <div class="table-responsive">
        <table class="table table-bordered">
          <?php if (!empty($title) || !empty($caption)): ?>
            <caption><?php print $caption . $title; ?></caption>
          <?php endif; ?>
          <?php if (!empty($header)) : ?>
            <thead>
            <tr>
              <th width="1%">TT</th>
              <?php foreach ($header as $field => $label): ?>
                <th
                  width="<?= ($field == 'nothing_1' || $field == 'nothing'||$field == 'nothing_2') ? '1%' : '' ?>">
                  <?php print $label; ?>
                </th>
              <?php endforeach; ?>
            </tr>
            </thead>
          <?php endif; ?>
          <tbody>
          <?php foreach ($rows as $row_count => $row): ?>
            <tr>
              <td>
                <?= $row_count + 1 ?>
              </td>
              <?php foreach ($row as $field => $content): ?>
                <td>
                  <?php print $content; ?>
                </td>
              <?php endforeach; ?>
            </tr>
          <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<!-- Bordered table end -->
