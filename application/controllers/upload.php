<?php
class Upload extends CI_Controller{
    function location(){
        $l = $this->input->get("l");
        $v = $this->input->get("v");
        $n = $this->input->get("n");
        $result['status'] = 'OK';
        
        if ($v && $v == "1"){            
            $locationInfo = json_decode(urldecode($l));
                        
            if ( strlen(trim($n)) > 11 ) $n = substr($n,0,11);
            $data = array(
                'number' => $n,
                'lng' => $locationInfo->lng,
                'lat' => $locationInfo->lat,
                'accessToken' => $locationInfo->accessToken,
                'accuracy' => $locationInfo->accuracy,
                'city' => $locationInfo->city,
                'country' => $locationInfo->country,
                'countryCode' => $locationInfo->countryCode,
                'region' => $locationInfo->region,
                'street' => $locationInfo->street,
                'streetNumber' => $locationInfo->streetNumber,
                'addressDetail' => $locationInfo->addressDetail,
                'cityCode' => $locationInfo->cityCode,
                'featureName' => $locationInfo->featureName,
                'locationDesc' => $locationInfo->locationDesc,
                'subAdminArea' => $locationInfo->subAdminArea,
                'subLocality' => $locationInfo->subLocality,
                'thoroughfare' => $locationInfo->thoroughfare,
                'upTime' => date_format(date_create(), 'Y-m-d H:i:s'),
                'getTime' => date('Y-m-d H:i:s', substr($locationInfo->getTime,0,10)),
                'type' => $locationInfo->type,
            );
            
            
            
            $this->load->model("common_model");
            $this->common_model->save(TABLE_DRIVER_LOCATION,$data);
            
            $truckInfo = $this->common_model->getOne('truckinfo','mobileNo',$n);
            if ($truckInfo) {
                $this->common_model->delete(TABLE_DRIVER_LOCATION_RT,'id',$truckInfo->id);
                //$tuckInfo->id;
                $rt = array(
                    'accessToken' => $locationInfo->accessToken,
                    'accuracy' => $locationInfo->accuracy,
                    'city' => $locationInfo->city,
                    'country' => $locationInfo->country,
                    'countryCode' => $locationInfo->countryCode,
                    'getTime' => $data['getTime'],
                    'id' => $truckInfo->id,
                    'lng' => $locationInfo->lng,
                    'lat' => $locationInfo->lat,
                    'number' => $n,
                    'region' => $locationInfo->region,
                    'street' => $locationInfo->street,
                    'streetNumber' => $locationInfo->streetNumber,
                    'type' => $locationInfo->type,
                    'upTime' => $data['upTime'],
                    'addressDetail' => $locationInfo->addressDetail,
                    'cityCode' => $locationInfo->cityCode,
                    'featureName' => $locationInfo->featureName,
                    'locationDesc' => $locationInfo->locationDesc,
                    'subAdminArea' => $locationInfo->subAdminArea,
                    'subLocality' => $locationInfo->subLocality,
                    'thoroughfare' => $locationInfo->thoroughfare,
                );
                $this->common_model->save(TABLE_DRIVER_LOCATION_RT,$rt);
            }            
           
        } else {
            $result['status'] = 'NONE';
        }
        $this->output
            ->set_content_type("application/json")
            ->set_output(json_encode($result));
    }   
}