@extends('layouts.default')
@section('content')


    <div class="container">
      <div class="row height d-flex justify-content-center align-items-center">
        <div class="col-md-8">
          <span>
            <h2><b>News API:</b></h2>

<h3>A Simple API to search and collect News and Blog Articles</h3>

          </span>
          <form method="post" id="qsearch-form">
            @csrf
          <div class="search">
            <i class="fa fa-search"></i>
            <input type="text" name="qsearch" class="form-control" placeholder="Google, Facebook, ...">
            <button type="button" class="btn btn-primary search-btn">
              Search
            </button>
          </div>
          </form>

          
        </div>
        
      </div>
      <div class="data-response"></div>
  </div>

<script type="text/javascript">
  $(function(){
    $(window).keydown(function(event){
      if(event.keyCode == 13) {
        event.preventDefault();
        return false;
      }
    });
    $('button.search-btn').on('click',function(){
      var qsearch=$('input[name=qsearch]').val().trim();
      if(qsearch!=''){
        $(this).html('<div class="spinner-border" role="status"><span class="visually-hidden"></span></div>');
        t = $(".data-response");
       $.ajax({
            type: "POST",
            url: '{{route("search-desktop-gnews")}}',
            data: $('#qsearch-form').serialize(),
            dataType:'HTML'
        }).done(function(e) {
            $(t).html(e);
             $('button.search-btn').html('Search');
        }).fail(function(e) {
            $(t).removeClass("success"), $(t).addClass("error"), "" !== e.responseText ? $(t).html(e.responseText) : $(t).text("Oops! An error occurred and your message could not be sent.");
             $('button.search-btn').html('Search');
        });

        

      }
       

    });
});
</script>
@endsection