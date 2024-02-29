<?php

namespace App\Service;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

class WaBlast
{
    public function send($phoneNumber, $sender)
    {
        $client = new Client();

        $headers = [
          'Authorization' => 'Bearer eyJhbGciOiJSUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiIxMjM0NTY3ODkwIiwiYXBwbGljYXRpb24iOiI2NWE4OTYwYTBmYWJhYzAwMTkyZTY2MzciLCJpYXQiOjE1MTYyMzkwMjJ9.OiZekdcoFNPLmjtCgjTtfH_HQ6h8BjrxnxxwV_0jO8Bcc2jUyJclLHCh5DeY1XAOugrgPEdA1Gt_RU8Dy9CWzpFAWbJUMrjkievzT5FKSdGXBUpstIsQyTWNL00fhXB1Tss14gxSD2_vCguNZb-6qynbUg_93kg4TJdu7W3Lfa_fZLtWvwewTkqnDUPU6YwHGAsHIxDwM1M-DsWJnJy346lZlsAYJQKl_TTYHypCThbNvHBsBJQTsAfR4oE1O0qfZCyJIo7Hmj_hMgseVLSdlDzs3CSV9VlFnRsdRvIncANfc49yGIWizbVejsAwNiuSfdxh5ovp294EqjqjoPCM7w',
          'Content-Type' => 'application/json'
        ];
        $body = '{
          "phone_number": "'.$phoneNumber.'",
          "message": {
            "type": "template",
            "template": {
              "template_code_id": "d7529850_b0a9_41fe_b49c_b7d78ed184de:sim_surat",
              "payload": [
                {
                  "position": "body",
                  "parameters": [
                    {
                      "type": "text",
                      "text": "' . $sender . '"
                    }
                  ]
                }
              ]
            }
          }
        }';
        $request = new Request('POST', 'https://wa01.ocatelkom.co.id/api/v2/push/message', $headers, $body);
        $res = $client->sendAsync($request)->wait();

        return $res->getBody();
    }

}



$client = new Client();
