@extends('backend.layouts.master')
@section('title', 'Expense')
@section('custom-styles')

@endsection
@section('main-content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Expense</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Expense</a>
                        </li>
                        <li class="breadcrumb-item active">Update</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="card">
            <div class="card-header">
                <h4>Expense Update</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('expense.update') }}">
                    @csrf
                    <div class="row">

                        <div class="col-md-12">
                            <div class="portlet box green">
                                <div class="portlet-body">
                                    @include('backend.layouts.notifications')
                                    <div class="table-scrollable">
                                        <table class="table table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th width="50">Action</th>
                                                    <th>Head Name</th>
                                                    <th>Remarks</th>
                                                    <th width="100">Qty</th>
                                                    <th width="120">Amount</th>
                                                    <th width="200">Sub Total</th>
                                                </tr>
                                            </thead>
                                            <tbody id="add-row-expense">
                                                @foreach ($get_expenses as $expense)
                                                    <input type="text" name="invoice_id"
                                                        value="{{ $expense->invoice_id }}" hidden>
                                                    @foreach ($expense->getExpenseDetails as $expense_details)
                                                    <input type="text" name="date_of_expense" value="{{ $expense_details->date_of_expense }}" hidden>

                                                        <tr class="expense_item">
                                                            <td class="text-left"><button type="button"
                                                                    class="btn btn-sm btn-danger remove_education"><i
                                                                        class="la la-trash"></i></button></td>

                                                            <td class="text-left">
                                                                <select name="head_id[]" id=""
                                                                    class="form-control select2">
                                                                    @foreach ($expense_heads as $cat)
                                                                        <option value="{{ $cat->id }}"
                                                                            {{ $expense_details->cat_id == $cat->id ? 'selected' : '' }}>
                                                                            {{ $cat->expense_head }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <input type="text" id="remarks" name="remarks[]" value="{{ $expense_details->remarks }}" class="form-control" required="">
                                                            </td>
                                                            <td width="20px" class="text-left">
                                                                <input type="number" id="quantity" onload="calculate()"
                                                                    onchange="calculate()"
                                                                    name="quantity[]"class="form-control quantity" required
                                                                    value="{{ $expense_details->quantity }}">
                                                            </td>
                                                            <td class="text-left"><input type="text" id="amount"
                                                                    onchange="calculate()" onload="calculate()"
                                                                    value="{{ $expense_details->amount }}" name="amount[]"
                                                                    class="form-control amount" required></td>
                                                            <td class="text-left"><input type="text" id="subtotal"
                                                                    name="subtotal[]"
                                                                    value="{{ $expense_details->subtotal }}"
                                                                    class="form-control subtotal" required>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="5"><b>Total</b></td>
                                                    <td>
                                                        <input type="text" id="grand_total" name="grand_total"
                                                            class="form-control" required="" value="{{ $grand_total }}"
                                                            readonly="">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="5">
                                                        <a class="btn btn-primary btn-sm" onclick="addRowExpense();"
                                                            href="javascript:void(0)">Add Row</a>
                                                    </td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>

                                    <div class="form-horizontal">
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label"></label>
                                            <div class="col-sm-6">
                                                <input type="submit" class="btn btn-success" name="submit" value="Update">
                                            </div>
                                        </div>
                                    </div>



                                    {{-- template --}}

                                </div>
                            </div>
                        </div>

                    </div>

                </form>
            </div>
        </div>
    </div>
    <template id="template_education">
        <tr class="expense_item">
            <td class="text-left"><button type="button" class="btn btn-sm btn-danger remove_education"><i
                        class="la la-trash"></i></button></td>
            <td class="text-left">
                <select name="head_id[]" id="" class="form-control select2">
                    @foreach ($expense_heads as $item)
                        <option value="{{ $item->id }}">{{ $item->expense_head }}</option>
                    @endforeach
                </select>
            </td>
            <td>
                <input type="text" id="remarks" name="remarks[]" class="form-control" required="">
            </td>
            <td width="20px" class="text-left">
                <input type="number" id="quantity" onchange="calculate()" name="quantity[]"class="form-control quantity"
                    required value="1">
            </td>
            <td class="text-left"><input type="text" id="amount" onchange="calculate()" name="amount[]"
                    class="form-control amount" required></td>
            <td class="text-left"><input type="text" id="subtotal" name="subtotal[]" class="form-control subtotal"
                    required></td>
        </tr>
    </template>

@endsection
@section('custom-scripts')
    <script>
        function addRowExpense() {
            var rowCount = $('#add-row-expense tr:last-child').attr('class');
            var html = $('#template_education').html();

            $('#add-row-expense').append(html);





        }

        $('body').on('click', '.remove_education', function() {
            $(this).closest('.expense_item').remove();
        });

        function calculate() {
            var grand_total = 0;
            $('.expense_item').each(function(index, element) {
                var quantity = parseFloat($('.quantity:eq(' + index + ')').val() || 0);
                var amount = parseFloat($('.amount:eq(' + index + ')').val() || 0);
                // var subtotal = parseFloat(|| 0);
                // var subtotal = ;
                var total = quantity * amount;

                $('.subtotal:eq(' + index + ')').val(total);
                grand_total = total + grand_total;


            });

            $("#grand_total").val(grand_total);
        }
    </script>
@endsection
