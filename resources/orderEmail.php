
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Emoey order email</title>
    
    <style>
    .invoice-box{
        max-width:800px;
        margin:auto;
        padding:30px;
        border:1px solid #eee;
        box-shadow:0 0 10px rgba(0, 0, 0, .15);
        font-size:16px;
        line-height:24px;
        font-family:'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        color:#555;
    }
    
    .invoice-box table{
        width:100%;
        line-height:inherit;
        text-align:left;
    }
    
    .invoice-box table td{
        padding:5px;
        vertical-align:top;
    }
    
    .invoice-box table tr td:nth-child(2){
        text-align:right;
    }
    
    .invoice-box table tr.top table td{
        padding-bottom:20px;
    }
    
    .invoice-box table tr.top table td.title{
        font-size:45px;
        line-height:45px;
        color:#333;
    }
    
    .invoice-box table tr.information table td{
        padding-bottom:40px;
    }
    
    .invoice-box table tr.heading td{
        background:#eee;
        border-bottom:1px solid #ddd;
        font-weight:bold;
    }
    
    .invoice-box table tr.details td{
        padding-bottom:20px;
    }
    
    .invoice-box table tr.item td{
        border-bottom:1px solid #eee;
    }
    
    .invoice-box table tr.item.last td{
        border-bottom:none;
    }
    
    .invoice-box table tr.total td:nth-child(2){
        border-top:2px solid #eee;
        font-weight:bold;
    }
    
    @media only screen and (max-width: 600px) {
        .invoice-box table tr.top table td{
            width:100%;
            display:block;
            text-align:center;
        }
        
        .invoice-box table tr.information table td{
            width:100%;
            display:block;
            text-align:center;
        }
    }
    </style>
</head>

<body>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="2">

                    <table>
                        <tr>
                            <td class="title">
                                <img src="http://emoey.southeastasia.cloudapp.azure.com/assets/img/logo_email.png" style="width:100%; max-width:125px; max-height:125px;">
                            </td>
                            
                            <td>
                                <h3>Order ID: <b> %orderid% </b>
                                </h3>
                                <br>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            
            <tr class="information">
                <td colspan="2">
                    <table>
                        <tr>
                            <td>
                               Order Due: %duedate% <br>
                               <b> Balance Due: %total%</b> 
                            </td>
                            
                            <td>
                                Bill To: <br>
                               <b> %customername% </b><br>
                               
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
             <tr class="heading">
                <td>Basket</td>
                  <td>%AddOnTitle%</td>
                  <td>Price</td>
            </tr>
            <tr class="details">
                <td>
                    %basketname%
                </td>
               
                <td>
                    %addons%
                </td>
                <td>
                    %price%
                </td>
            </tr>
            <tr class="details">
                <td>
                   
                </td>
               
                <td>
                   
                </td>
                <td>
                    <tbody id="subtotal-checkout">
                                <tr>
                                <td colspan="4" align="right" style="padding:3px 9px;font-family:Verdana,Arial;font-weight:normal;border-collapse:collapse;vertical-align:top;margin:0">Subtotal</td>
                                <td id="checkoutAddonsTotal" align="right" style="padding:3px 9px;font-family:Verdana,Arial;font-weight:normal;border-collapse:collapse;vertical-align:top;margin:0">%subtotal%</td>
                                </tr>
                                <tr>
                                <td colspan="4" align="right" style="padding:3px 9px;font-family:Verdana,Arial;font-weight:normal;border-collapse:collapse;vertical-align:top;margin:0">Basket</td>
                                <td  id="basketCategoryPrice" align="right" style="padding:3px 9px;font-family:Verdana,Arial;font-weight:normal;border-collapse:collapse;vertical-align:top;margin:0">%basketprice%</td>
                                </tr>
                                  <tr>
                                <td colspan="4" align="right" style="padding:3px 9px;font-family:Verdana,Arial;font-weight:normal;border-collapse:collapse;vertical-align:top;margin:0">Voice message</td>
                                <td id="checkoutVoiceMessage" align="right" style="padding:3px 9px;font-family:Verdana,Arial;font-weight:normal;border-collapse:collapse;vertical-align:top;margin:0">%voiceprice%</td>
                                </tr>
                                <tr>
                                <td colspan="4" align="right" style="padding:3px 9px;font-family:Verdana,Arial;font-weight:normal;border-collapse:collapse;vertical-align:top;margin:0">Shipping & Handling</td>
                                <td align="right" style="padding:3px 9px;font-family:Verdana,Arial;font-weight:normal;border-collapse:collapse;vertical-align:top;margin:0">0</td>
                                </tr>
                                <tr>
                                <td colspan="4" align="right" style="padding:3px 9px;font-family:Verdana,Arial;font-weight:normal;border-collapse:collapse;vertical-align:top;margin:0"><b>Grand Total</b></td>
                                <td id="grandTotal" align="right" style="padding:3px 9px;font-family:Verdana,Arial;font-weight:normal;border-collapse:collapse;vertical-align:top;margin:0">%total%</td>
                                </tr>
                                </tbody>
                </td>
            </tr>
            
            <tr class="heading">
                <td>
                    Payment Method
                </td>
                
                <td>
                    Details
                </td>
            </tr>
            

            <tr class="details">
                <td>
                    Bank Account Details (Wire Transfer) 
                </td>
                
                <td>
                    Bank Islami, Acc # 202000653070001, Acc Title Muhammad Bilal Javed
                </td>
               
            </tr>
             <tr class="details">
                <td>
                    Easy Pay 
                </td>
                
                <td>
                    Mobile Acc # 03486792503
                </td>
                
            </tr>
             <tr class="details">
                 <td>
                 COD
                </td>
                <td>Cash on delivery</td>
            </tr>
          
          
        </table>
        <p>Terms:</p>
        <p>Kindly, Select one of the payment mode and pay before the due date to confirm your order.
                Thanks</p>
        <p><small>Copyright; 2015-2018</small></p>
    </div>
</body>
</html>
