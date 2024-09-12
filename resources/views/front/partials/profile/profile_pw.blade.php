<div class="row">
                               
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <form class="form" id="pw-form" name="pw-form" action='#' onsubmit="return false"
        method="post" enctype="multipart/form-data">
        <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
        <div class="row">
            <div class="col-md-6 form-group">
                <label>Eski Şifreniz</label>
                <input class="form-control" type="password" placeholder="" maxlength="100" name="password_old" id="password_old" value="">
            </div>
      
            <div class="col-md-6 form-group">
                 
            </div>
            <div class="col-md-6 form-group">
               
               
            <label>Yeni Şifreniz</label>
            <input class="form-control" type="password" placeholder="" maxlength="100" name="password" id="password" value="">
                
            </div>
            <div class="col-md-6 form-group">
                <label>Yeni Şifreniz Tekrar</label>
                <input class="form-control" type="password" placeholder="" maxlength="100" name="password_confirm" id="password_confirm" value="">
                
             
            </div>
            


           

           

            <div class="col-md-12 form-group d-flex justify-content-center">
                <button class="btn btn-primary font-weight-bold py-3 w-50" onclick="pwFormSubmit()" id="submit_button_pw">Güncelle</button>
            </div>

        </div>

            </form>
    </div>
</div>
