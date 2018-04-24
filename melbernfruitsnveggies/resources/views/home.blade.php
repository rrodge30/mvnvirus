@extends('layouts.app')

@section('content')

<div class="container">


	<div class="row">
			
			
		<div class="col-md-12">
				<h3>Branch</h3>
				<div class="input-group">
						
						<select class="custom-select" id="input-select-branch" value="" name="branch" required="required">
							<option value="">Choose Branch</option>
						@if(isset($data['branch']) && $data['branch'])
							@foreach($data['branch'] as $key=>$value)
								@if($data["id_branch"] == $value->id_branch)
									<option selected="selected" value="{{$value->id_branch}}">{{$value->branch_name}}</option>
								@else
								<option value="{{$value->id_branch}}">{{$value->branch_name}}</option>
								@endif
							@endforeach
							
						@endif
						</select>
					@if(Auth::user()->user_level == "99")
						<div class="input-group-append">
							<button style="height:34px;" class="btn btn-outline-secondary btn-add-branch" type="button"><i class="material-icons">add</i></button>
						</div>
						<div class="input-group-append">
							<button style="height:34px;" class="btn btn-outline-secondary btn-delete-branch" type="button"><i class="material-icons">delete</i></button>
						</div>
					@endif
				</div>
		</div>
		<div class="col-md-12" style="padding:0;margin-top:50px;">
			<form id="frm-table-list">
				<input type="hidden" name="id_branch" value="{{$data["id_branch"]}}">
					@csrf
				<table id="list_table" class="table table-bordered" style="width:100%">
					<thead>	
						<th class="text-center"><input type="checkbox" class="" id="listCheckBoxAll"></th>
						<th class="text-center">#</th>
						<th class="text-center">
							<span class="text-center pull-left" style="padding-top:20px;padding-left:10px;">ITEM NAME</span>
							@if(Auth::user()->user_level == "99")
								<button class="btn btn-outline-secondary btn-add-item" type="button" form="frm-add-record">
									<i class="material-icons">add</i>
								</button>
							@endif
						</th>
						<th class="text-center">UNIT</th>
						<th class="text-center">QUANTITY</th>
						<th class="text-center">PRICE</th>
						@if(Auth::user()->user_level == "99")
							<th class="text-center">ACTION</th>
						@endif
					</thead>
					<tbody>
						
						@if(isset($data['items']) && $data['items'])
							@foreach($data['items'] as $key=>$value)
						
								<tr class="tr-pdf-input">
									
									<td class="text-center">
										<input type="checkbox" class="listCheckBox" name="row_selected[]" value="{{$value->id_item}}">	
									</td>
									
									<td class="text-center">
										<input type="hidden" name="id_items[]" value="{{$value->id_item}}">
										{{$key+1}}
									</td>

									<td class="text-center">
										<input type="hidden" name="item_name[]" value="{{$value->item_name}}">
										{{$value->item_name}}
									</td>
									<td class="text-center">
										<input type="hidden" name="item_unit[]" value="{{$value->item_unit}}">
										{{$value->item_unit}}	
										
									</td>
									<td class="text-center">	
										<input type="text" class="form-control" name="item_quantity[]" pattern="[0-9]{1,10}" autocomplete="no">
									</td>
									<td class="text-center">
										<input type="text" class="form-control" name="item_price[]" pattern="(?<=^| )\d+(\.\d+)?(?=$| )|(?<=^| )\.\d+(?=$| )" autocomplete="no">
									</td>
									
									@if(Auth::user()->user_level == "99")
										<td class="text-center">
												<button data-id="{{$value->id_item}}" class="btn btn-danger btn-delete-item" type="button"><i class="material-icons">delete</i></button>										</td>
									@endif
								</tr>
							@endforeach
							
						@endif
					</tbody>
					<tfoot>
							
					</tfoot>
				</table>
			</form>
		</div>
		
	</div>
	<br><br>
	@guest
	@else
		<button class="btn btn-primary pull-right btn-list-to-pdf" type="submit" form="frm-table-list"><span class="material-icons">assignment</span><span style="vertical-align:top;">Preview</span></button>
	@endguest
</div>


						
{{-- /*
|--------------------------------------------------------------------------
| SCRIPT
|--------------------------------------------------------------------------
|
*/ --}}

<script type="text/javascript">

$(document).ready(function() {


	$('#list_table').DataTable({
		"order": [[ 1, "asc" ]],
		"columnDefs": [ {
		"targets": 0,
		"orderable": false
		} ],
    } );
	
	//PREVIEW SELECTED ITEMS (MODAL SHOW)
	$(document).on('submit','#frm-table-list',function(e){
		e.preventDefault();
		var frm = $(this);
		var SelectedRows = $('input.listCheckBox:checked');

		if(SelectedRows.length == 0){
			return false;
		}

		var htmlbody = '';
		var selectedRows = $('#frm-table-list').find('tbody').find('tr').has('input[type=checkbox]:checked');
		
		$('#modal-center-dialog-header.modal-title').html('<b>Item List</b>');
		
		htmlbody += '<form id="frm-list-selected-item">'
						+'<input type="hidden" name="id_branch" value="{{$data["id_branch"]}}">'
						+'<table class="table">'
							+'<thead>'
								+'<th class="text-center">#</th>'
								+'<th class="text-center">ITEM NAME</th>'
								+'<th class="text-center">UNIT</th>'
								+'<th class="text-center">QUANTITY</th>'
								+'<th class="text-center">PRICE</th>'
								+'<th class="text-center">TOTAL PRICE</th>'
							+'</thead>'
							+'<tbody style="font-family:Times New Roman, Times, serif;font-size:18px;">';
							var grandTotal = 0;
							for(i=0;i<selectedRows.length;i++){
								var rowInputs = selectedRows.eq(i).find('input'); // INDEX 1 START TO 0 IS CHECKBOX VALUE ONLY
								grandTotal+= (rowInputs[4].value*rowInputs[5].value);
								htmlbody += '<tr>'
												+'<td class="text-center">'
													+(i+1)
													+'<input type="hidden" name="id_items[]" value="'+rowInputs[1].value+'">'
												+'</td>'
												+'<td class="text-center" style="width:400px;">'
													+rowInputs[2].value
													+'<input type="hidden" name="item_name[]" value="'+rowInputs[2].value+'">'
												+'</td>'
												+'<td class="text-center">'
													+rowInputs[3].value
													+'<input type="hidden" name="item_unit[]" value="'+rowInputs[3].value+'">'
												+'</td>'
												+'<td class="text-center">'
													+rowInputs[4].value
													+'<input type="hidden" name="item_quantity[]" value="'+rowInputs[4].value+'">'
												+'</td>'
												+'<td class="text-center">'
													+(parseInt(rowInputs[5].value)).toLocaleString("en", {minimumFractionDigits: 2, maximumFractionDigits: 2})
													+'<input type="hidden" name="item_price[]" value="'+rowInputs[5].value+'">'
												+'</td>'
												+'<td class="text-center">'
													+(rowInputs[4].value*rowInputs[5].value).toLocaleString("en", {minimumFractionDigits: 2, maximumFractionDigits: 2})
												+'</td>'
											+'</tr>';
								
							}
							
							htmlbody +='</tbody>'
										+'<tfoot>'
											+'<tr>'
												+'<td></td>'
												+'<td></td>'
												+'<td></td>'
												+'<td></td>'
												+'<td style="text-align:right;font-weight:bold;">GRAND TOTAL:</td>'
												+'<td class="text-center" style="font-weight:bold">'+grandTotal.toLocaleString("en", {minimumFractionDigits: 2, maximumFractionDigits: 2})+'</td>'
											+'</tr>'
										+'</tfoot>'
									+'</table>'
								+'</form>';

		$('#modal-center-dialog .modal-body').html(htmlbody);

		var htmlfooter = '<button type="submit" form="frm-list-selected-item" class="btn btn-success"><span style="vertical-align:top;">Tender</span></button>'
						+'<button type="button" class="btn btn-secondary" data-dismiss="modal"><span style="vertical-align:top;">Cancel</span></button>';
		
                
		$('#modal-center-dialog .modal-footer').html(htmlfooter);
		$('#modal-center-dialog').modal('show');
		$('#modal-center-dialog .modal-dialog').attr('style','max-width:90%;max-height:700px;overflow-y:auto;');
		
	});
	
		
	//PDF
	$(document).on('submit','#frm-list-selected-item',function(e){
		e.preventDefault();
		var frm = $(this);
		var action="{{route('pdf.export.list')}}";
		window.location.href = action + '?' + frm.serialize();
		
	});
	
	//EVENTS
	$(document).on('change','.listCheckBox',function(e){
		var checkBox = $(this);
		if(checkBox.is(':checked')){
			var rowInputs = checkBox.parent().parent('tr').find('input[type=text]');
			rowInputs.attr('required','required');
			rowInputs[0].focus();
			rowInputs[0].setAttribute('placeholder','Enter Quantity');
			rowInputs[1].setAttribute('placeholder','Enter Price');
		}else{
			var rowInputs = checkBox.parent().parent('tr').find('input[type=text]');
			rowInputs.attr("required",false);
			rowInputs[0].removeAttribute('placeholder');
			rowInputs[1].removeAttribute('placeholder');
		}
	});

	
	$(window).keypress(function (e) {
	if (e.key === ' ' || e.key === 'Spacebar') {
		if ( $('input:focus').length === 0 ) {
			  $('input[type=search]')[0].focus();
			  return; 
		}
	}
	})
	$(document).on('click','#listCheckBoxAll',function(e){
		var checkBoxAll = $(this);
		var tableInputs = $('#list_table').find('input[type=text]');
		if(checkBoxAll.is(':checked')){
			$('.listCheckBox').prop('checked',true);

			tableInputs.attr('required','required');
			if(tableInputs.length > 0){
				for(i=0;i<tableInputs.length;i++){
					tableInputs[i].setAttribute('placeholder','Enter Quantity');
					tableInputs[i].setAttribute('placeholder','Enter Price');
				}
			}
			

		}else{
			$('.listCheckBox').prop('checked',false);
			
			tableInputs.attr("required",false);
			tableInputs.removeAttr('placeholder');

		}
		
	});

	$(document).on('change','#input-select-branch',function(e){
		e.preventDefault();
		var selectBranchValue = (($(this).val() != "") ? $(this).val() : '-1');

		var url = '{{ route("list.branch.change", ":id") }}';
		
		url = url.replace(':id', selectBranchValue);

		window.location.href=url;

	});

	/*-----------------------------------------------------------------------*/

	/*
	|--------------------------------------------------------------------------
	| Branch 
	|--------------------------------------------------------------------------
	|
	*/
	//ADD
	$('.btn-add-branch').on('click',function(e){
		e.preventDefault();

		$('#modal-center-dialog-header').html('Add Branch');
		var url = '{{ route("branch.add") }}';
		var body ='<form id="frm-add-branch" action="'+url+'">' 
				  +'<input class="form-control" type="text" placeholder="Enter Branch Name" name="branch_name" required="required" autofocus="autofocus" autocomplete="no">'
		$('#modal-center-dialog-body').html(body);

		var footer = '<button type="submit" class="btn btn-primary" form="frm-add-branch">Add Branch</button>'
                	 +'<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button></form>';
		$('#modal-center-dialog-footer').html(footer);

		$('#modal-center-dialog').modal('show');
	});
	//DELETE
	$(document).on('click','.btn-delete-branch',function(e){
		e.preventDefault();
		var selectBranchValue = $('#input-select-branch').val();

		if(selectBranchValue == ""){
			return false;
		}
		
		swal({
            title: "Are You Sure?",
            text: "Do You Want to Delete This Record ?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes",
            cancelButtonText: "No, ",
            closeOnConfirm: false,
            closeOnCancel: false,
            },
            function(isConfirm){
                if (isConfirm) {
                    var url = '{{ route("branch.delete", ":id") }}';

                    url = url.replace(':id', selectBranchValue);

                    window.location.href=url;
                
                }else{
                    swal("Cancelled", "Delete Canceled.", "error"); 
                }
		});
	});
	/*-----------------------------------------------------------------------*/

	/*
	|--------------------------------------------------------------------------
	| Item
	|--------------------------------------------------------------------------
	|
	*/

	//ADD
	$('.btn-add-item').on('click',function(e){
		e.preventDefault();
		var selectBranchValue = $('#input-select-branch').val();

		if(selectBranchValue == ""){
			return false;
		}
		
		$('#modal-center-dialog-header').html('Add Item');
		var url = '{{ route("item.add") }}';
		
		var body ='<form id="frm-add-item" action="'+url+'">'
				  +'<input class="form-control" type="hidden" name="id_branch" value="'+selectBranchValue+'">'
				  +'<label>Item name</label>'
				  +'<input class="form-control" type="text" placeholder="Enter Item Name" name="item_name" required="required" autofocus="autofocus" autocomplete="no">'
				  +'<br><label>Unit</label>'
				  +'<br><input clas="form-control" list="item_unit" type="text" name="item_unit" required="required" placeholder="Enter item unit" style="width:100%;">'
					+'<datalist id="item_unit">'
							+'<option value="Piece">'
							+'<option value="Box">'
							+'<option value="Gram">'
							+'<option value="Kilogram">'
							+'<option value="Pound">'
							+'<option value="Bundle">'
					+'</datalist>';
		$('#modal-center-dialog-body').html(body);

		var footer = '<button type="submit" class="btn btn-primary" form="frm-add-item">Add Item</button>'
                	 +'<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button></form>';
		$('#modal-center-dialog-footer').html(footer);

		$('#modal-center-dialog').modal('show');
	});
	//DELETE
	$(document).on('click','.btn-delete-item',function(e){
		e.preventDefault();

		var btn = $(this);
		var id = btn.data('id');
		swal({
            title: "Are You Sure?",
            text: "Do You Want to Delete This Record ?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes",
            cancelButtonText: "No, ",
            closeOnConfirm: false,
            closeOnCancel: false,
            },
            function(isConfirm){
                if (isConfirm) {
					var url = '{{ route("item.delete") }}?id_item='+id+ '&id_branch=' + '{{ $data["id_branch"] }}';
                    window.location.href=url;

                }else{
                    swal("Cancelled", "Delete Canceled.", "error"); 
                }
		});
	});

	

	/*-----------------------------------------------------------------------*/

});
</script>
@endsection
