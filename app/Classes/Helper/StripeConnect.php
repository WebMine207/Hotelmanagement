<?php

namespace App\Classes\Helper;

use App\User;
use Stripe;

class StripeConnect
{

	private $stripe;

	public function __construct() {
		$this->stripe = new \Stripe\StripeClient(config('services.stripe.secret'));
		return $this;
	}

	/**
	 * Create new customer.
	 *
	 * @param $data
	 *
	 * @return array
	 */
	public static function createCustomer($data) {
		try {
			$stripe = new \Stripe\StripeClient(config('services.stripe.secret'));

            // first check if customer exists based on email in stripe if exists then don't create a new one
            try {
                $findCustomer = $stripe->customers->all(['email' => $data['email'], 'limit' => 1]);

                if ($findCustomer['data']) {
                    return [
                        'res_status' => 'success',
                        'id' => $findCustomer['data'][0]['id'],
                    ];
                }
            } catch (\Exception $e) {
                return [
                    'res_status' => 'error',
                    'message' => $e->getMessage(),
                ];
            }

			$customer = $stripe->customers->create($data);
			return [
				'res_status' => 'success',
				'id' => $customer['id']
			];
		} catch (\Exception $e){
			return [
				'res_status' => 'error',
				'message' => $e->getMessage()
			];
		}
	}

    public static function updateCustomer($id, $data){
        try {
            $stripe = new \Stripe\StripeClient(config('services.stripe.secret'));
            $customer = $stripe->customers->update($id, $data);
            return [
                'res_status' => 'success',
                'id' => $customer['id']
            ];
        } catch (\Exception $e){
            return [
                'res_status' => 'error',
                'message' => $e->getMessage()
            ];
        }
    }

	/**
	 * Create card.
	 *
	 * @param $stripe_id
	 * @param $data
	 *
	 * @return Response
	 */
	public static function createCard($stripe_id,$data){

		try{
			$stripe = new \Stripe\StripeClient(config('services.stripe.secret'));

			$token = $stripe->tokens->create([
				'card' => $data,
			]);

			$response = $stripe->customers->createSource(
				$stripe_id,
				['source' => $token->id]
			);

			$response['res_status'] = 'success';

			return $response;
		} catch (\Exception $e){
			$response = [
				'res_status' => 'error',
				'message' => $e->getMessage()
			];
			return $response;
		}
	}

    /**
     * Get card.
     *
     * @param $stripe_id
     *
     */
    public static function getCard($custId, $cardId){
        try{
            $stripe = new \Stripe\StripeClient(config('services.stripe.secret'));

            $response = $stripe->customers->retrieveSource($custId, $cardId);
            return $response;
        } catch (\Exception $e){
            $response = [
                'res_status' => 'error',
                'message' => $e->getMessage()
            ];
            return $response;
        }
    }

	/**
	 * Update default card.
	 *
	 * @param $stripe_id
	 * @param $card_id
	 *
	 * @return array
	 */
	public static function updateDefaultCard($stripe_id, $card_id) {
		try{
			$stripe = new \Stripe\StripeClient(config('services.stripe.secret'));

			$response = $stripe->customers->update(
				$stripe_id,
				['invoice_settings' => ['default_payment_method' => $card_id]]
			);

			$response['res_status'] = 'success';

			return $response;
		} catch (\Exception $e){
			$response = [
				'res_status' => 'error',
				'message' => $e->getMessage()
			];
			return $response;
		}
	}

	/**
	 * Create Invoice
	 *
	 * @param $stripe_id
	 * @param $data
	 *
	 * @return array
	 */
	public static function createInvoice($stripe_id, $data) {
		try{
			$stripe = new \Stripe\StripeClient(config('services.stripe.secret'));

			if(!empty($data['invoice']['items'])){
				foreach($data['invoice']['items'] as $lineItem) {
					$invoiceItem = $stripe->invoiceItems->create([
						'customer' => $stripe_id,
						'amount'   => $lineItem['amount'],
						'currency' => 'CAD',
						'description' => $lineItem['description'],
					]);
				}

				$response = $stripe->invoices->create([
					'customer' => $stripe_id,
				]);

				$response['res_status'] = 'success';
				return $response;
			}
		} catch (\Exception $e){
			$response = [
				'res_status' => 'error',
				'message' => $e->getMessage()
			];
			return $response;
		}
	}

	/**
	 * Pay Invoice
	 *
	 * @param $invoice_id
	 *
	 * @return array
	 */
	public static function payInvoice($invoice_id){
		try{
			$stripe = new \Stripe\StripeClient(config('services.stripe.secret'));
			$response = $stripe->invoices->pay($invoice_id);

			$response['res_status'] = 'success';
			return $response;
		} catch (\Exception $e){
			$response = [
				'res_status' => 'error',
				'message' => $e->getMessage()
			];
			return $response;
		}
	}

	/**
	 * Delete card.
	 *
	 * @param $stripe_id
	 * @param $card_id
	 *
	 * @return array
	 */
	public static function deleteCard($stripe_id, $card_id) {
		try{
			$stripe = new \Stripe\StripeClient(config('services.stripe.secret'));

			$response = $stripe->customers->deleteSource(
				$stripe_id,
				$card_id
			);

			$response['res_status'] = 'success';

			return $response;
		} catch (\Exception $e){
			$response = [
				'res_status' => 'error',
				'message' => $e->getMessage()
			];
			return $response;
		}
	}

    public static function createProduct($name, $description, $metadata = [], $id = NULL){
        try{
            $stripe = new \Stripe\StripeClient(config('services.stripe.secret'));
            
            $params = [
                'name' => $name,
                'active' => true,
                'description' => $description,
                'metadata' => $metadata
            ];
            if($id){
                $params['id'] = $id;
            }
            $response = $stripe->products->create($params);

            $response['res_status'] = 'success';

            return $response;
        } catch (\Exception $e){
            $response = [
                'res_status' => 'error',
                'message' => $e->getMessage()
            ];
            return $response;
        }
    }

    public static function createPrice($currency, $product, $unitAmount, $metadata = [], $loopupKey = NULL, $interval = 'month'){
        try{
            $stripe = new \Stripe\StripeClient(config('services.stripe.secret'));

            $params = [
                'currency' => $currency,
                'product' => $product,
                'unit_amount' => $unitAmount,
                'active' => true,
                'metadata' => $metadata,
                'recurring' => [
                    'interval' => $interval,
                    'interval_count' => 1,
                    'usage_type' => 'licensed'
                ]
            ];
            if($loopupKey){
                $params['lookup_key'] = $loopupKey;
            }
            $response = $stripe->prices->create($params);

            $response['res_status'] = 'success';

            return $response;
        } catch (\Exception $e){
            $response = [
                'res_status' => 'error',
                'message' => $e->getMessage()
            ];
            return $response;
        }
    }

    public static function getSubscription($stripeId){
        try{
            $stripe = new \Stripe\StripeClient(config('services.stripe.secret'));

            $response = $stripe->subscriptions->retrieve($stripeId);
            return $response;
        } catch (\Exception $e){
            $response = [
                'res_status' => 'error',
                'message' => $e->getMessage()
            ];
            return $response;
        }
    }

    public static function createSubscription($customerId, $priceId, $promo = NULL, $trialDays = NULL){
        try{
            $stripe = new \Stripe\StripeClient(config('services.stripe.secret'));

            $parameter = [
                "customer" => $customerId,
                "items" => [
                    [
                        "price" => $priceId,
                        "quantity" => 1,
                    ],
                ],
                'payment_behavior' => 'allow_incomplete',
                'proration_behavior' => 'create_prorations',
            ];
            if($promo){
                $parameter['promotion_code'] = $promo;
            }
            if($trialDays){
                $parameter['trial_period_days'] = $trialDays;
            }

            $response = $stripe->subscriptions->create($parameter);

            $response['res_status'] = 'success';

            return $response;
        } catch (\Exception $e){
            $response = [
                'res_status' => 'error',
                'message' => $e->getMessage()
            ];
            return $response;
        }
    }

    public static function cancelSubscription($stripeId){
        try{
            $stripe = new \Stripe\StripeClient(config('services.stripe.secret'));

            $response = $stripe->subscriptions->cancel($stripeId);

            $response['res_status'] = 'success';

            return $response;
        } catch (\Exception $e){
            $response = [
                'res_status' => 'error',
                'message' => $e->getMessage()
            ];
            return $response;
        }
    }

    public static function updateSubscription($subscriptionId, $itemId, $priceId, $promo = NULL){
        try{
            $stripe = new \Stripe\StripeClient(config('services.stripe.secret'));

            $parameter = [
                "items" => [
                    [
                        "id" => $itemId,
                        "price" => $priceId
                    ],
                ],
            ];
            if($promo){
                $parameter['promotion_code'] = $promo;
            }

            $response = $stripe->subscriptions->update($subscriptionId, $parameter);

            $response['res_status'] = 'success';

            return $response;
        } catch (\Exception $e){
            $response = [
                'res_status' => 'error',
                'message' => $e->getMessage()
            ];
            return $response;
        }
    }

    public static function createCoupon($name, $amount, $percentage){
        try{
            $stripe = new \Stripe\StripeClient(config('services.stripe.secret'));

            $parameter = [
                'currency' => 'USD',
                'duration' => 'once',
                'name' => $name,
            ];

            if($amount){
                $parameter['amount_off'] = $amount * 100;
            } elseif ($percentage){
                $parameter['percent_off'] = $percentage;
            }
            $response = $stripe->coupons->create($parameter);

            $response['res_status'] = 'success';

            return $response;
        } catch (\Exception $e){
            $response = [
                'res_status' => 'error',
                'message' => $e->getMessage()
            ];
            return $response;
        }
    }

    public static function updateCoupon($id, $name){
        try{
            $stripe = new \Stripe\StripeClient(config('services.stripe.secret'));

            $response = $stripe->coupons->update($id, [
                'name' => $name,
            ]);

            $response['res_status'] = 'success';

            return $response;
        } catch (\Exception $e){
            $response = [
                'res_status' => 'error',
                'message' => $e->getMessage()
            ];
            return $response;
        }
    }

    public static function deleteCoupon($id){
        try{
            $stripe = new \Stripe\StripeClient(config('services.stripe.secret'));

            $response = $stripe->coupons->delete($id);

            $response['res_status'] = 'success';

            return $response;
        } catch (\Exception $e){
            $response = [
                'res_status' => 'error',
                'message' => $e->getMessage()
            ];
            return $response;
        }
    }

    public static function getCoupon($id){
        try{
            $stripe = new \Stripe\StripeClient(config('services.stripe.secret'));

            $response = $stripe->coupons->retrieve($id);

            $response['res_status'] = 'success';

            return $response;
        } catch (\Exception $e){
            $response = [
                'res_status' => 'error',
                'message' => $e->getMessage()
            ];
            return $response;
        }
    }

    public static function getPromocode($code){
        try{
            $stripe = new \Stripe\StripeClient(config('services.stripe.secret'));

            $response = $stripe->promotionCodes->all(['code' => $code, 'active' => true]);

            $response['res_status'] = 'success';

            return $response;
        } catch (\Exception $e){
            $response = [
                'res_status' => 'error',
                'message' => $e->getMessage()
            ];
            return $response;
        }
    }

    public static function getPrice($stripeId){
        try{
            $stripe = new \Stripe\StripeClient(config('services.stripe.secret'));

            $response = $stripe->prices->retrieve($stripeId);
            return $response;
        } catch (\Exception $e){
            $response = [
                'res_status' => 'error',
                'message' => $e->getMessage()
            ];
            return $response;
        }
    }

    public static function searchPrice($lookupKey){
        try{
            $stripe = new \Stripe\StripeClient(config('services.stripe.secret'));

            $response = $stripe->prices->all([
                'lookup_keys' => [$lookupKey],
                'limit' => 1
            ]);
            return $response;
        } catch (\Exception $e){
            $response = [
                'res_status' => 'error',
                'message' => $e->getMessage()
            ];
            return $response;
        }
    }

    public static function getProduct($stripeId){
        try{
            $stripe = new \Stripe\StripeClient(config('services.stripe.secret'));

            $response = $stripe->products->retrieve($stripeId);
            return $response;
        } catch (\Exception $e){
            $response = [
                'res_status' => 'error',
                'message' => $e->getMessage()
            ];
            return $response;
        }
    }

    public static function getInvoice($stripeId){
        try{
            $stripe = new \Stripe\StripeClient(config('services.stripe.secret'));

            $response = $stripe->invoices->retrieve($stripeId);
            $response['res_status'] = 'success';
            return $response;
        } catch (\Exception $e){
            $response = [
                'res_status' => 'error',
                'message' => $e->getMessage()
            ];
            return $response;
        }
    }

    public static function getCharges($card_id, $customerId, $amount, $description = '', $currency = 'usd'){
        try{
            $stripe = new \Stripe\StripeClient(config('services.stripe.secret'));

            $response = $stripe->charges->create([
                'amount'        => $amount,
                'currency'      => $currency,
                'customer'      => $customerId,
                'source'        => $card_id,
                'description'   => $description,
              ]);
            $response['res_status'] = 'success';
            return $response;
        } catch (\Exception $e){
            $response = [
                'res_status' => 'error',
                'message' => $e->getMessage()
            ];
            return $response;
        }
    }
}
