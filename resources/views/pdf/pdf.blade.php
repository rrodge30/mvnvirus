<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="{{asset('public/js/jquery-3.1.0.min.js')}}"></script>
    <link rel="stylesheet" href="{{asset('public/css/bootstrap.min.css')}}" type="text/css">
    <script src="{{asset('public/js/bootstrap.min.js')}}"></script>

    {{-- fonts --}}
   
    <style>
        html,body{
            font-family: 'Raleway', sans-serif;
            font-weight: 100 !important;
            text-align: center;
        }
        td{
            font-family: "Times New Roman", Times, serif !important; 
            text-align:center;
            font-size:7px;
            
        }
       
        .bold{
            font-weight: bold !important;
        }
    </style>
</head>
<body>
        <div class="container" style="">
                <div class="row" style="text-align:left;">
                        <h6 class="brand bold">MELBERN FRUITS n' VEGGIES</h6>
                </div>
                <div class="row">
                        <table class="table table-bordered" style="border-radius:15px !important;width:340px !important;">
                            <tr style="border-radius:15px !important;">
                                <td style="width:206px;padding-left:10px;padding-top:0px;padding-bottom:0px;" class="">
                                    <h6 class="brand bold"><i>SALES ORDER</i></h6>
                                </td>
                                
                                <td style="width:100px;">
                                    <table>
                                        <tr>
                                            <td style="text-align:left;padding-left:10px;">
                                                DATE:
                                            </td>
                                          
                                        </tr>
                                        <tr>
                                            <td style="text-align:left;padding:10px 0 0 10px;">
                                                TRANS NO: <span class="bold">{{str_pad($data["id_trans"],6,0,STR_PAD_LEFT)}}</span>
                                            </td>
                                        </tr>  
                                    </table>
                                </td>
                            </tr>
                           <tr>
                               <td style="text-align:left">
                                    FROM: <span class="bold">{{$data["branch"]->branch_name}}</span>
                               </td>
                               <td style="text-align:left">
                                    
                               </td>
                           </tr>
                           <tr>
                                <td style="text-align:left">
                                    TO:
                                </td>
                                <td></td>
                           </tr>
                        </table>
                    </div>
                    
                    
                    <div class="row" style="margin-top:0px; padding-top:0px;width:200px !important;">
                        <table id="list_table" class="table table-stripe table-bordered" style="margin-top:0px; padding-top:0px;width:200px !important;">
                            <thead>
                                <tr>
                                    <td style="width:5px;" class="bold">Qty</td>
                                    <td style="width:5px;" class="bold">Unit</td>
                                    <td style="width:130px;" class="bold">DESCRIPTION OF ARTICLES</td>
                                    <td style="width:5px;" class="bold">Unit Price</td>
                                    <td class="bold">AMOUNT</td>
                                    <td class="bold">TOTAL AMOUNT</td>
                                </tr>
                            </thead>
                            <tbody style="width:200px !important;">
                                @if($data)
                                    <?php
                                        $totalAmount = 0;
                                    ?>
                                    @foreach($data["items"] as $key=>$value)
                                        <tr style="width:200px;">
                                            <td style="width:5px;">{{$value["item_quantity"]}}</td>
                                            <td style="width:5px;">{{$value["item_unit"]}}</td>
                                            <td style="width:130px;">{{$value["item_name"]}}</td>
                                            <td>P</td>
                                            <td style="width:5px;">{{number_format($value["item_price"],2)}}</td>
                                            <td>{{number_format(($value["item_price"] * $value["item_quantity"]),2)}}</td>
                                            <?php
                                                $totalAmount += $value["item_price"]* $value["item_quantity"];
                                            ?>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                            <tfoot style="width:200px !important;">
                                <td><i></i></td>
                                <td>,</td>
                                <td>Thank You Come Again !</td>
                                <td></td>
                                <td class="pull-right bold">GRAND TOTAL:</td>
                                <td class="bold">{{number_format($totalAmount,2)}}</td>
                            </tfoot>
                        </table>
                    </div>
                    
                    <div class="row">
                        <table class="table table-bordered" style="width:340px !important;height:50px;">
                            <tr style="padding: 0 2px 0 2px;height:50px;">
                                <td style="">
                                    <div style="text-align:left">Prepared By 
                                        <br><br>
                                        <hr></div>
                                    <div class="text-center" style="height:2px;">
                                        <span class="bold">AUTHORIZE SIGNATURE</span>
                                    </div>
                                </td>
                                <td style="">
                                    <div style="text-align:left">
                                            Received in good order and condition the above described merchandise
                                            <hr>
                                    </div>
                                    <div class="text-center" style="height:2px;">
                                        
                                            <span class="bold">CUSTOMER SIGNATURE</span>
                                    </div>
                                </td>
                                
                            </tr>
                        </table>
                    </div>
        </div>
</body>
</html>