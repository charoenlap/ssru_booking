<!-- Page Content  -->
<div id="content-page" class="content-page">
   <div class="container-fluid">
      <div class="row">
         <div class="col-sm-12">
            <div class="iq-card">
               <div class="iq-card-header d-flex justify-content-between">
                  <div class="iq-header-title">
                     <h4 class="card-title">Banner</h4>
                  </div>
               </div>
               <div class="iq-card-body">
                  <div class="row">
                     <div class="col-md-12">
                        <label for="">อัพโหลดรูปภาพ</label>
                        <div class="form-group">
                           <div class="custom-file">
                              <input type="file" class="custom-file-input" id="customFile">
                              <label class="custom-file-label" for="customFile">Choose file</label>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-12">
                        <button class="btn btn-primary">Submit</button>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<script>
   $(document).ready(function() {
      $('#banner').addClass('active');
   });
   $('#datatables').DataTable();
</script>
      
