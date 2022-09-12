<?php

namespace App\Controller;

use App\Traits\ApiResponse;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class MiscController extends BaseController
{
    use ApiResponse;

    private $tosContent = '<!DOCTYPE html> <html dir="ltr" lang="en" class="" lazy-loaded="true"> <head> <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Terms of Service</title>
  </head>
  <body style="background-color: rgb(53, 54, 58)">
    <div>
      <h1>RBXExpert Terms of Services</h1>
    </div>
    <div>
      <p>Last Update: December 2021</p>
    </div>
    <div>
      <p>
        Welcome to Fiverr.com. The following terms of service (these "Terms of
        Service"), govern your access to and use of the Fiverr website and
        mobile application, including any content, functionality and services
        offered on or through www.fiverr.com or the Fiverr mobile application
        (the "Site") by Fiverr International Ltd. (8 Kaplan St. Tel Aviv
        6473409, Israel) and its subsidiaries: Fiverr Inc. (38 Greene St. NY
        10013, NY, USA) and Fiverr Limited (Lemesou 11, 2112 Nicosia, Cyprus),
        as applicable. Fiverr International Ltd. and its subsidiaries are
        collectively referred hereto as "Fiverr" "we" or "us" and “you” or
        “user” means you as an user of the Site. Please read the Terms of
        Service carefully before you start to use the Site. By using the Site,
        opening an account or by clicking to accept or agree to the Terms of
        Service when this option is made available to you, you accept and agree,
        on behalf of yourself or on behalf of your employer or any other
      </p>
    </div>
  </body>
</html>
';

    private $pPolicyContent = '
<!DOCTYPE html>
        <html dir="ltr" lang="en" class="" lazy-loaded="true">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Terms of Service</title>
  </head>
  <body style="background-color: rgb(53, 54, 58)">
    <div>
      <h1>RBXExpert Terms of Services</h1>
    </div>
    <div>
      <p>Last Update: December 2021</p>
    </div>
    <div>
      <p>
        Welcome to Fiverr.com. The following terms of service (these "Terms of
        Service"), govern your access to and use of the Fiverr website and
        mobile application, including any content, functionality and services
        offered on or through www.fiverr.com or the Fiverr mobile application
        (the "Site") by Fiverr International Ltd. (8 Kaplan St. Tel Aviv
        6473409, Israel) and its subsidiaries: Fiverr Inc. (38 Greene St. NY
        10013, NY, USA) and Fiverr Limited (Lemesou 11, 2112 Nicosia, Cyprus),
        as applicable. Fiverr International Ltd. and its subsidiaries are
        collectively referred hereto as "Fiverr" "we" or "us" and “you” or
        “user” means you as an user of the Site. Please read the Terms of
        Service carefully before you start to use the Site. By using the Site,
        opening an account or by clicking to accept or agree to the Terms of
        Service when this option is made available to you, you accept and agree,
        on behalf of yourself or on behalf of your employer or any other
      </p>
    </div>
  </body>
</html>
';

    public function getToSPolicy(Request $request, Response $response): Response
    {
        $params = (array)$request->getQueryParams();
        if ($params['name'] === 'terms-of-service') {
            return $this->sendResponse(this->$tosContent);
        }

        if ($params['name'] === 'privacy-policy') {
            return $this->sendResponse(json_encode(this->$pPolicyContent));
        }

    }
}