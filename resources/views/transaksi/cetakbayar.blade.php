<x-templete_top :data="$data" />

<style type="text/css">
  td.number {
      text-align: right;
  }  

  .form-control:disabled {
      color: #000;
      background-color: #fff;
      opacity: 1;
  }  

  .select2-container--disabled .select2-selection--single:not([class*=bg-]) {
      color: #000;
      background-color: #fff;
  }

</style>
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <!-- <form action="/{{$mainroute}}" method="GET"> -->
      <div class="card-header header-elements-inline">
        <!-- <h5 class="card-title">{{$data['page_active']??''}}</h5> -->
            <div class="col-md-3">
              <h5 class="card-title">
                    <select name="filterPeriode" id="filterPeriode" class="form-control" onchange="searchfilter()">
                      <option value="0">Filter Periode</option>
                      @foreach($filterPeriode as $key => $combodata)
                      <option value="{{$combodata->comboValue}}" 

                            @if($vperiode==$combodata->comboValue) 
                              {{"selected"}} 
                            @endif 

                      >{{$combodata->comboLabel}}</option>
                      @endforeach
                    </select>          
              </h5>
            </div>
            <div class="col-md-3">
            <h5 class="card-title">
              <select name="filterBulan" id="filterBulan" class="form-control" onchange="searchfilter()">
                <option value="0">Filter Bulan</option>
                @foreach($filterBulan as $key => $combodata)
                <option value="{{$combodata->comboValue}}"
                      @if($vbulan==$combodata->comboValue) 
                        {{"selected"}} 
                      @endif 
                >{{$combodata->comboLabel}}</option>
                @endforeach
              </select>                    
            </h5>
            </div>
            <div class="col-md-3">
            <h5 class="card-title">
              <select name="filterTahun" id="filterTahun" class="form-control" onchange="searchfilter()">
                <option value="0">Filter Tahun</option>
                @foreach($filterTahun as $key => $combodata)
                <option value="{{$combodata->comboValue}}" 
                      @if($vtahun==$combodata->comboValue) 
                        {{"selected"}} 
                      @endif 
                >{{$combodata->comboLabel}}</option>
                @endforeach
              </select>                    
            </h5>
            </div>  
            <div class="col-md-3">
            <h5 class="card-title">
              <select name="filterBendahara" id="filterBendahara" class="form-control" onchange="searchfilter()">
                <option value="0" 
                      @if($vbendahara==0) 
                        {{"selected"}} 
                      @endif 

                >Semua Bendahara</option>
                @foreach($filterBendahara as $key => $combodata)
                <option value="{{$combodata->comboValue}}" 
                      @if($vbendahara==$combodata->comboValue) 
                        {{"selected"}} 
                      @endif 
                >{{$combodata->comboLabel}}</option>
                @endforeach
              </select>                    
            </h5>
            </div>  
      </div>
      <!-- </form> -->
        <div class="card-body">
        <div class="table-responsive">
          <table id="tData" class="table table-striped table-bordered table-hover" style="width:100%">
            <thead>
              <tr>
                @php $cols = count($grid)+1; @endphp
                @foreach($grid as $datagrid)
                <th width="{{$datagrid['width']}}">{{$datagrid['label']}}</th>
                @endforeach
              </tr>
            </thead>
            <tbody>
              @if(!$listdata->isEmpty())
              @php
              $rowIndex=-1;
              @endphp

              @foreach($listdata as $key => $data)
              <tr>
                @php
                $pmKey=$data->$primaryKey;
                $rowIndex ++;
                @endphp

                @foreach($grid as $datagrid)
                    @php
                    $field=$datagrid['field'];
                    $value=$data->$field;
                    @endphp
                    @if($datagrid['type']=='number')
                        <td width="{{$datagrid['width'] ?? ''}}" class="{{$datagrid['type'] ?? ''}}" >{{number_format($value)}} </td>
                    @else
                        <td width="{{$datagrid['width'] ?? ''}}" class="{{$datagrid['type'] ?? ''}}" >{{$value}} </td>
                    @endif
                @endforeach
              </tr>
              @endforeach

              <tr style="font-weight: bold;">
                <td colspan="3" class="text">TOTAL</td>
                <td class="number">{{number_format($totalKonfirmasi)}}</td>
                <td class="number">{{number_format($totalBayar)}}</td>
                <td class="number">{{number_format($totalSisa)}}</td>
                <td class="text">&nbsp;</td>
              </tr>


              @else
              <tr>
                <td colspan="{{$cols}}">
                  <center><i class="fa fa-info-circle"></i> Data Empty </center>
                </td>
              </tr>
              @endif
            </tbody>

          </table>
        </div>

        <br>
        <div class="text-right">
          {{ $listdata->appends(array('search' => $search ?? ''))->links('pagination::bootstrap-4') }}
        </div>

    <!-- /basic layout -->
    </div>
    </div>
  </div>
</div>



<script type="text/javascript">
  function save() {
    var jenis = document.getElementById('{{$primaryKey}}').value;
    if (jenis == '') {
      saveNew('{{$primaryKey}}');
    } else {
      saveEdit('{{$primaryKey}}');
    }
  }

  function saveNew(primaryKey) {
    // var field = document.getElementById('formAllField').value;
    // var fieldobj = JSON.parse(field);
    // var postdata = {};
    // postdata._token = document.getElementsByName('_token')[0].defaultValue;
    // postdata.compId = document.getElementById('compId').value;
    // for (var j = 0; j < fieldobj.length; j++) {
    //   var data = document.getElementById(fieldobj[j].field).value;
    //   var evalText = 'postdata.' + fieldobj[j].field + "='" + data + "'";
    //   eval(evalText);
    // }
    // $.ajax({
    //   type: "POST",
    //   url: "/{{$mainroute}}",
    //   data: (postdata),
    //   dataType: "json",
    //   async: false,
    //   success: function(data) {
    //     if (data.status == 401) {
    //       alertify.error('Form Wajib Harus diisi');
    //       return;
    //     } else {
    //       alertify.success('Berhasil Disimpan');
    //       setTimeout(function() {
    //         window.open("{{$mainroute}}", "_self");
    //       }, 500);
    //     }
    //   },
    //   error: function(dataerror) {
    //     console.log(dataerror);
    //   }
    // });

  }
  function searchfilter(){
    var periode = document.getElementById('filterPeriode').value;
    var bulan = document.getElementById('filterBulan').value;
    var tahun = document.getElementById('filterTahun').value;
    var bendahara = document.getElementById('filterBendahara').value;

    var link="?filterPeriode="+periode+"&filterBulan="+bulan+"&filterTahun="+tahun+"&filterBendahara="+bendahara;

    window.open("{{$mainroute}}"+link, "_self");

  }

  function saveEdit(primaryKey) {
    // console.log('saveEdit');
    var field = document.getElementById('formAllField').value;
    var fieldobj = JSON.parse(field);
    var pkValue = document.getElementById(primaryKey).value;
    var postdata = {};
    postdata._token = document.getElementsByName('_token')[0].defaultValue;
    postdata.compId = document.getElementById('compId').value;

    for (var j = 0; j < fieldobj.length; j++) {
      var data = document.getElementById(fieldobj[j].field).value;
      var evalText = 'postdata.' + fieldobj[j].field + "='" + data + "'";
      eval(evalText);
    }

    $.ajax({
      type: "PUT",
      url: "{{$mainroute}}/" + pkValue,
      data: (postdata),
      dataType: "json",
      async: false,
      success: function(data) {
        // console.log(data);
        if (data.status == 401) {
          alertify.error('Form Wajib Harus diisi');
          return;
        } else {
          alertify.success('Berhasil Diupdate');
          setTimeout(function() {
            window.open("{{$mainroute}}", "_self");
          }, 500);
        }
      },
      error: function(dataerror) {
        console.log(dataerror);
      }
    });

  }

  function grid_edit(id, primaryKey) {
    var data = document.getElementById('alldata').value;
    var dataobj = JSON.parse(data).data;
    for (var i = 0; i < dataobj.length; i++) {
      var a = 'dataobj[i].' + primaryKey.id;
      // console.log(a);
      if (eval(a) == id) {
        var field = document.getElementById('formAllField').value;
        var fieldobj = JSON.parse(field);
        //masukkan PK dulu
        document.getElementById(primaryKey.id).value = id;
        //masukkan field yang lain
        for (var j = 0; j < fieldobj.length; j++) {
          var b = 'dataobj[i].' + fieldobj[j].field;
          // console.log(fieldobj[j].type);
          if (fieldobj[j].type != 'password') {
            if (fieldobj[j].type == 'combo'){
              $("#"+fieldobj[j].field).val(eval(b)).find(':selected').trigger('change');
            }else if (fieldobj[j].type == 'autocomplete'){
              setAutocompleteVal(fieldobj[j].url, eval(b), fieldobj[j].text, fieldobj[j].field);
            }else{
              document.getElementById(fieldobj[j].field).value = eval(b);
            }
          }
        }
      }
    }
  }

  function setAutocompleteVal(api,idx,tx,field) {
    $.ajax({
      type: "GET",
      url: api,
      data: ({
        text: eval(tx),
        search: idx,
      }),
      dataType: "json",
      success: function(data) {
        // console.log(data);
        if (data[0].id) {
          // Set selected   
          var $newOption = $("<option selected='selected'></option>").val(data[0].id).text(data[0].text);
          $("#" + field).append($newOption).trigger('change');
        } else {
          $('#' + field).val(null).trigger('change');
        }

      }
    });
  }

  function grid_delete(id, pmkey) {
    var postdata = {};
    postdata._token = document.getElementsByName('_token')[0].defaultValue;

    alertify.confirm('Anda Akan Menghapus Data ?',
      function() {
        $.ajax({
        type: "DELETE",
        url: "/{{$mainroute}}/" + id,
        data: (postdata),
        dataType: "json",
        async: false,
        success: function(data) {
          alertify.success('Berhasil Dihapus');
          setTimeout(function() {
            window.open("{{$mainroute}}", "_self");
          }, 500);
        },
        error: function(dataerror) {
          console.log(dataerror);
        }
      });
      },
      function() {
        alertify.dismissAll();
      }).setHeader('<b> Hapus Data !</b> ');

  }
</script>


<x-templete_bottom />