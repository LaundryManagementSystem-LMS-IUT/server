<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Library\SslCommerz\SslCommerzNotification;
use App\Models\billing;

class SslCommerzPaymentController extends Controller
{

    public function exampleEasyCheckout()
    {
        return view('exampleEasycheckout');
    }

    public function exampleHostedCheckout()
    {
        return view('exampleHosted');
    }

    public function index(Request $request)
    {
        # Here you have to receive all the order data to initate the payment.
        # Let's say, your oder transaction informations are saving in a table called "orders"
        # In "orders" table, order unique identity is "transaction_id". "payment_status" field contain payment_status of the transaction, "amount" is the order amount to be paid and "currency" is for storing Site Currency which will be checked with paid currency.

        $orderID=$request->input('order_id');
        $post_data = array();
        $post_data['total_amount'] = $request->input('amount'); # You cant not pay less than 10
        $post_data['currency'] = "BDT";
        $post_data['tran_id'] = $orderID; // tran_id must be unique

        # CUSTOMER INFORMATION
        $full_name=$request->input('full_name');
        $post_data['cus_name'] = $full_name['firstname'].' '.$full_name['lastname'];
        $post_data['cus_email'] = $request->input('email');
        $post_data['cus_add1'] = $request->input('address');
        $post_data['cus_add2'] = "";
        $post_data['cus_city'] = "";
        $post_data['cus_state'] = "";
        $post_data['cus_postcode'] = "";
        $post_data['cus_country'] = "Bangladesh";
        $post_data['cus_phone'] = $request->input('phone_number');
        $post_data['cus_fax'] = "";

        # SHIPMENT INFORMATION
        $post_data['ship_name'] = "Shipping of Order ID: "+$orderID;
        $post_data['ship_add1'] = $request->input('address');
        $post_data['ship_add2'] = $request->input('address');
        $post_data['ship_city'] = $request->input('city');
        $post_data['ship_state'] = "";
        $post_data['ship_postcode'] = "";
        $post_data['ship_phone'] = $request->input('phone_number');
        $post_data['ship_country'] = "BANGLADESH";

        $post_data['shipping_method'] = "NO";
        $post_data['product_name'] = "Laundry";
        $post_data['product_category'] = "Clothes and Accessories";
        $post_data['product_profile'] = "textile-goods";

        # OPTIONAL PARAMETERS
        $post_data['value_a'] = "ref001";
        $post_data['value_b'] = "ref002";
        $post_data['value_c'] = "ref003";
        $post_data['value_d'] = "ref004";

        #Before  going to initiate the payment order payment_status need to insert or update as Pending.
            billing::where('order_id',$orderID)->updateOrInsert([
                
            ]);
            $full_name=$request->input('full_name');
            $location=$request->input('location');
            DB::statement('UPDATE billings SET address=ROW(' . $location['lat'] . ', ' . $location['lng'] . ')::ADDRESS_TYPE WHERE order_id=\'' . $orderID . '\'');
            DB::statement('UPDATE billings SET address=ROW(' . $full_name['firstname'] . ', ' . $full_name['middlename'] . ', '.$full_name['lastname'].')::FULL_NAME WHERE order_id=\'' . $orderID . '\'');

        $sslc = new SslCommerzNotification();
        # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
        $payment_options = $sslc->makePayment($post_data, 'hosted');

        if (!is_array($payment_options)) {
            print_r($payment_options);
            $payment_options = array();
        }

    }

    public function payViaAjax(Request $request)
    {

        # Here you have to receive all the order data to initate the payment.
        # Let's say, your oder transaction informations are saving in a table called "orders"
        # In "orders" table, order unique identity is "transaction_id". "payment_status" field contain payment_status of the transaction, "amount" is the order amount to be paid and "currency" is for storing Site Currency which will be checked with paid currency.

        $orderID=$request->input('order_id');
        $post_data = array();
        $post_data['total_amount'] = $request->input('amount'); # You cant not pay less than 10
        $post_data['currency'] = "BDT";
        $post_data['tran_id'] = $orderID; // tran_id must be unique

        # CUSTOMER INFORMATION
        $full_name=$request->input('full_name');
        $post_data['cus_name'] = $full_name['firstname'].' '.$full_name['lastname'];
        $post_data['cus_email'] = $request->input('email');
        $post_data['cus_add1'] = $request->input('address');
        $post_data['cus_add2'] = "";
        $post_data['cus_city'] = "";
        $post_data['cus_state'] = "";
        $post_data['cus_postcode'] = "";
        $post_data['cus_country'] = "Bangladesh";
        $post_data['cus_phone'] = $request->input('phone_number');
        $post_data['cus_fax'] = "";

        # SHIPMENT INFORMATION
        $post_data['ship_name'] = "Shipping of Order ID: "+$orderID;
        $post_data['ship_add1'] = $request->input('address');
        $post_data['ship_add2'] = $request->input('address');
        $post_data['ship_city'] = $request->input('city');
        $post_data['ship_state'] = "";
        $post_data['ship_postcode'] = "";
        $post_data['ship_phone'] = $request->input('phone_number');
        $post_data['ship_country'] = "BANGLADESH";

        $post_data['shipping_method'] = "NO";
        $post_data['product_name'] = "Laundry";
        $post_data['product_category'] = "Clothes and Accessories";
        $post_data['product_profile'] = "textile-goods";

        # OPTIONAL PARAMETERS
        $post_data['value_a'] = "ref001";
        $post_data['value_b'] = "ref002";
        $post_data['value_c'] = "ref003";
        $post_data['value_d'] = "ref004";


        #Before  going to initiate the payment order payment_status need to update as Pending.
        billing::where('order_id',$orderID)->updateOrInsert([
                
        ]);
        $full_name=$request->input('full_name');
        $location=$request->input('location');
        DB::statement('UPDATE billings SET address=ROW(' . $location['lat'] . ', ' . $location['lng'] . ')::ADDRESS_TYPE WHERE order_id=\'' . $orderID . '\'');
        DB::statement('UPDATE billings SET address=ROW(' . $full_name['firstname'] . ', ' . $full_name['middlename'] . ', '.$full_name['lastname'].')::FULL_NAME WHERE order_id=\'' . $orderID . '\'');

        $sslc = new SslCommerzNotification();
        # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
        $payment_options = $sslc->makePayment($post_data, 'checkout', 'json');

        if (!is_array($payment_options)) {
            print_r($payment_options);
            $payment_options = array();
        }

    }

    public function success(Request $request)
    {
        echo "Transaction is Successful";

        $tran_id = $request->input('order_id');
        $amount = $request->input('amount');
        $currency = $request->input('currency');

        $sslc = new SslCommerzNotification();

        #Check order payment_status in order tabel against the transaction id or order id.
        $order_details=billing::find($tran_id);

        if ($order_details->payment_status == 'Pending') {
            $validation = $sslc->orderValidate($request->all(), $tran_id, $amount, $currency);

            if ($validation) {
                /*
                That means IPN did not work or IPN URL was not set in your merchant panel. Here you need to update order payment_status
                in order table as Processing or Complete.
                Here you can also sent sms or email for successfull transaction to customer
                */
                $update_product = billing::where('order_id', $tran_id)
                    ->update(['payment_status' => 'Complete']);

                echo "<br >Transaction is successfully Completed";
            }
        } else if ($order_details->payment_status == 'Processing' || $order_details->payment_status == 'Complete') {
            /*
             That means through IPN Order payment_status already updated. Now you can just show the customer that transaction is completed. No need to udate database.
             */
            echo "Transaction is successfully Completed";
        } else {
            #That means something wrong happened. You can redirect customer to your product page.
            echo "Invalid Transaction";
        }


    }

    public function fail(Request $request)
    {
        $tran_id = $request->input('order_id');

        #Check order payment_status in order tabel against the transaction id or order id.
        $order_details=billing::find($tran_id);

        if ($order_details->payment_status == 'Pending') {
            $update_product = billing::where('order_id', $tran_id)
            ->update(['payment_status' => 'Failed']);
            echo "Transaction is Falied";
        } else if ($order_details->payment_status == 'Processing' || $order_details->payment_status == 'Complete') {
            echo "Transaction is already Successful";
        } else {
            echo "Transaction is Invalid";
        }

    }

    public function cancel(Request $request)
    {
        $tran_id = $request->input('order_id');

        #Check order payment_status in order tabel against the transaction id or order id.
        $order_details=billing::find($tran_id);

        if ($order_details->payment_status == 'Pending') {
            $update_product = $update_product = billing::where('order_id', $tran_id)
            ->update(['payment_status' => 'Cancelled']);
            echo "Transaction is Cancel";
        } else if ($order_details->payment_status == 'Processing' || $order_details->payment_status == 'Complete') {
            echo "Transaction is already Successful";
        } else {
            echo "Transaction is Invalid";
        }


    }

    public function ipn(Request $request)
    {
        #Received all the payement information from the gateway
        if ($request->input('order_id')) #Check transation id is posted or not.
        {

            $tran_id = $request->input('order_id');

            #Check order payment_status in order tabel against the transaction id or order id.
            $order_details = billing::find($tran_id);

            if ($order_details->payment_status == 'Pending') {
                $sslc = new SslCommerzNotification();
                $validation = $sslc->orderValidate($request->all(), $tran_id, $order_details->amount, $order_details->currency);
                if ($validation == TRUE) {
                    /*
                    That means IPN worked. Here you need to update order payment_status
                    in order table as Processing or Complete.
                    Here you can also sent sms or email for successful transaction to customer
                    */
                     $update_product = billing::where('order_id', $tran_id)
                    ->update(['payment_status' => 'Processing']);

                    echo "Transaction is successfully Completed";
                }
            } else if ($order_details->payment_status == 'Processing' || $order_details->payment_status == 'Complete') {

                #That means Order payment_status already updated. No need to udate database.

                echo "Transaction is already successfully Completed";
            } else {
                #That means something wrong happened. You can redirect customer to your product page.

                echo "Invalid Transaction";
            }
        } else {
            echo "Invalid Data";
        }
    }

}
