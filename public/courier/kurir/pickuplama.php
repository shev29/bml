 
              <!-- /.card-header -->
              <!-- form start 
			   `no_order`, `idalamat_asal`, `idalamat_tujuan`, `penerima`, `pengirim`,
			   `nama_barang`, `jml_barang`, `nik_kurir`, `no_hp_penerima`, `waktu`,
			   `status`, `ket1`, `ket2`, `aktif`
			  
			  -->
             

		 
     <div class="form-group">
                    <label for="exampleInputEmail1">Destination</label>
                     <!-- Dropdown -->       
        <select id='selUser2' class="form-control form-control-lg" name='idalamat_tujuan'  style='width: 800px;'>  
 
        </select>   

        <input type='button' value='Show Detail' id='but_read2'>

        <br/>
        <div id='result2'></div>

        <!-- Script -->
        <script>
        $(document).ready(function(){
            
            // Initialize select2
            $("#selUser2").select2();

            // Read selected option
            $('#but_read2').click(function(){
                var username = $('#selUser2 option:selected').text();
                var userid = $('#selUser2').val();
           
                $('#result2').html("Alamat Lengkap : " + username);
            });
        });
        </script>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">File input</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="exampleInputFile">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text">Upload</span>
                      </div>
                    </div>
                  </div>
                  <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Check me out</label>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
 
          <!--/.col (right) -->
 