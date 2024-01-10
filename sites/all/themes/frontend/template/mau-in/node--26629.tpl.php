<?php ?>
<section class="full-editor">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title text-mau-in">Mẫu in</h4>
          <div class="text-right">
            <button class="btn btn-primary btn-luu-mau-in"><i data-feather='file-text'></i> Lưu mẫu in</button>
          </div>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-sm-12">
              <div id="full-wrapper">
                <div id="full-container">
                  <textarea name="editor" id="editor" rows="20">
                                        <?=getMauIn()?>
                  </textarea>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<script>
  $(document).ready(function (){
    if($("#editor").length>0){
      CKEDITOR.replace('editor');
    }
  })
</script>
