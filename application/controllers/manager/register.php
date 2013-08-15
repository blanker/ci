<?php
class Register extends CI_Controller{
    function truck_info(){
        $a = $this->input->get('a');
        $ao = json_decode( urldecode($a) );
        
        //echo "<pre>";        
        //print_r($ao);
        //echo "</pre>";
        
        $this->load->model("common_model");
        $systemUser = $this->common_model->getOne("systemuser","mobileNo", $ao->registerInfo->regPhone);
        if ( !$systemUser) {
            $systemUser = $this->common_model->getOne("systemuser","userId", $ao->registerInfo->regPhone);
        }
        if ( ! $systemUser){
            $result['msg'] = '帐号有问题，请重新登录';
            $result['status'] = 'ERROR';
        } else {
            if ($systemUser->encryptedPass != $ao->registerInfo->regPassword){
                $result['msg'] = '帐号（密码）有问题，请重新登录';
                $result['status'] = 'ERROR';
            } else {
                $makeTime = date_format(date_create(), 'Y-m-d H:i:s');
                $truckInfo = array(
                    'makeTime' => $makeTime,
                    'createUserId' => $systemUser->id,
                    'createUserName' => $ao->registerInfo->regUsername,
                    'bodyStruc' => $ao->truckInfo->bodyStruc,
                    'capacity' => $ao->truckInfo->capacity,
                    'driverName' => $ao->truckInfo->driverName,
                    'driverSex' => $ao->truckInfo->driverSex,
                    'drivingLicense' => $ao->truckInfo->drivingLicense,
                    'freqLine' => $ao->truckInfo->freqLine,
                    'licenseType' => $ao->truckInfo->licenseType,
                    'locCity' => $ao->truckInfo->locCity,
                    'locRegion' => $ao->truckInfo->locRegion,
                    'locProvince' => $ao->truckInfo->locProvince,
                    'mobileNo' => $ao->truckInfo->mobileNo,
                    'plateNo' => $ao->truckInfo->plateNo,
                    'runningToken' => $ao->truckInfo->runningToken,
                    'truckBrand' => $ao->truckInfo->truckBrand,
                    'truckLength' => $ao->truckInfo->truckLength,
                    'truckType' => $ao->truckInfo->truckType,
                    'truckVolumn' => $ao->truckInfo->truckVolumn,
                    'auditUserId' => $ao->truckInfo->auditUserId,
                    'truckState' => $ao->truckInfo->truckState,
                );
                
                $id = $this->common_model->save(TABLE_TRUCK_INFO, $truckInfo);
                if ( $id ) {
                    $ti = $this->common_model->getOne(TABLE_TRUCK_INFO, 'id', $id);
                    if ($ti) {
                        //print_r($ti);
                        $his = array(
                            'modifyType' => 1,
                            'modifyTime' => $makeTime,
                            'createUserId' => $systemUser->id,
                            'createUserName' => $ao->registerInfo->regUsername,
                            'bodyStruc' => $ao->truckInfo->bodyStruc,
                            'capacity' => $ao->truckInfo->capacity,
                            'driverName' => $ao->truckInfo->driverName,
                            'driverSex' => $ao->truckInfo->driverSex,
                            'drivingLicense' => $ao->truckInfo->drivingLicense,
                            'freqLine' => $ao->truckInfo->freqLine,
                            'licenseType' => $ao->truckInfo->licenseType,
                            'locCity' => $ao->truckInfo->locCity,
                            'locRegion' => $ao->truckInfo->locRegion,
                            'locProvince' => $ao->truckInfo->locProvince,
                            'mobileNo' => $ao->truckInfo->mobileNo,
                            'plateNo' => $ao->truckInfo->plateNo,
                            'runningToken' => $ao->truckInfo->runningToken,
                            'truckBrand' => $ao->truckInfo->truckBrand,
                            'truckLength' => $ao->truckInfo->truckLength,
                            'truckType' => $ao->truckInfo->truckType,
                            'truckVolumn' => $ao->truckInfo->truckVolumn,
                            'truckInfoId' => $ti->id ,
                            'truckState' => $ao->truckInfo->truckState,
                            'auditUserId' => $ao->truckInfo->auditUserId,
                         );
                         $this->common_model->save(TABLE_TRUCK_INFO_HIS, $his);
                     }
                 }
                 
                 $result['status'] = 'OK';
            }
            
            $this->output
                ->set_content_type("application/json")
                ->set_output(json_encode($result));
        }
        
        /*        
	
		his.setPlateNo(ti.getPlateNo());
		his.setRunningToken(ti.getRunningToken());
		his.setTruckBrand(ti.getTruckBrand());
		his.setTruckInfoId(ti.getId());
		his.setTruckLength(ti.getTruckLength());
		his.setTruckState(ti.getTruckState());
		his.setTruckType(ti.getTruckType());
		his.setTruckVolumn(ti.getTruckVolumn());
        
        truckInfo.setBodyStruc ( ((CodeValues)spinnerBodyStruc.getSelectedItem()).getCode() );
					truckInfo.setCapacity( ((CodeValues)spinnerCapacity.getSelectedItem()).getCode() );
					truckInfo.setDriverName(etDriverName.getText().toString().trim());
					truckInfo.setDriverSex( Integer.parseInt(((CodeValues)spinnerBodyStruc.getSelectedItem()).getCode() ))		;
					truckInfo.setDrivingLicense(etDrivingLicense.getText().toString().trim());
					truckInfo.setFreqLine(etFreqLine.getText().toString().trim());
					truckInfo.setLicenseType(((CodeValues)spinnerLicenseType.getSelectedItem()).getCode() );
					truckInfo.setLocCity( ((City)spinnerLocCity.getSelectedItem()).getId() );
					truckInfo.setLocRegion( ((Region)spinnerLocRegion.getSelectedItem()).getId() );
					truckInfo.setLocProvince( ((Province)spinnerLocProvince.getSelectedItem()).getId() );
					truckInfo.setMobileNo(etMobileNo.getText().toString().trim());
					truckInfo.setPlateNo(etPlateNo.getText().toString().trim());
					truckInfo.setRunningToken(etRunningToken.getText().toString().trim());
					truckInfo.setTruckBrand(etTruckBrand.getText().toString().trim());
					truckInfo.setTruckLength( ((CodeValues)spinnerTruckLength.getSelectedItem()).getCode() );
					truckInfo.setTruckType(((CodeValues)spinnerTruckType.getSelectedItem()).getCode());
					truckInfo.setTruckVolumn(Float.parseFloat( etTruckVolumn.getText().toString().trim() ));
					truckInfo.setGetTime(new Date());
					truckInfo.setMakeTime(new Date());
		TruckInfoHis his = copyToHis(truckInfo, user, now, 1);
		truckInfoDao.save(his);*/
			
			
    }
    
    function freight_source(){
        $a = $this->input->get('a');
        $ao = json_decode( urldecode($a) );
        
        $this->load->model("common_model");
        $systemUser = $this->common_model->getOne("systemuser","mobileNo", $ao->registerInfo->regPhone);
        if ( !$systemUser) {
            $systemUser = $this->common_model->getOne("systemuser","userId", $ao->registerInfo->regPhone);
        }
        if ( ! $systemUser){
            $result['msg'] = '帐号有问题，请重新登录';
            $result['status'] = 'ERROR';
        } else {
            $makeTime = date_format(date_create(), 'Y-m-d H:i:s');
            $freightSource = array(
                    'makeTime' => $makeTime,
                    'createUserId' => $systemUser->id,
                    'createUserName' => $ao->registerInfo->regUsername,
                    'attention' => $ao->freightSource->attention,
                    'destCity' => $ao->freightSource->destCity,
                    'destProvince' => $ao->freightSource->destProvince,
                    'destRegion' => $ao->freightSource->destRegion,
                    'freightName' => $ao->freightSource->freightName,
                    'freightType' => $ao->freightSource->freightType,
                    'freightVolumn' => $ao->freightSource->freightVolumn,
                    'freightWeight' => $ao->freightSource->freightWeight,
                    'originCity' => $ao->freightSource->originCity,
                    'originProvince' => $ao->freightSource->originProvince,
                    'originRegion' => $ao->freightSource->originRegion,
                    'packType' => $ao->freightSource->packType,
                    //'auditUserId' => $ao->freightSource->auditUserId,
                    'freightState' => 0,
                );
            $id = $this->common_model->save(TABLE_FREIGHT_SOURCE, $freightSource);
            if ( $id ) {
                $fs = $this->common_model->getOne(TABLE_FREIGHT_SOURCE, 'id', $id);
                if ($fs) {
                    //print_r($fs);
                    $his = array(
                        'modifyType' => 1,
                        'modifyTime' => $makeTime,
                        'createUserId' => $systemUser->id,
                        'createUserName' => $ao->registerInfo->regUsername,
                        'attention' => $ao->freightSource->attention,
                        'destCity' => $ao->freightSource->destCity,
                        'destProvince' => $ao->freightSource->destProvince,
                        'destRegion' => $ao->freightSource->destRegion,
                        'freightName' => $ao->freightSource->freightName,
                        'freightType' => $ao->freightSource->freightType,
                        'freightVolumn' => $ao->freightSource->freightVolumn,
                        'freightWeight' => $ao->freightSource->freightWeight,
                        'originCity' => $ao->freightSource->originCity,
                        'originProvince' => $ao->freightSource->originProvince,
                        'originRegion' => $ao->freightSource->originRegion,
                        'packType' => $ao->freightSource->packType,
                        'freightSourceId' => $fs->id ,
                        'freightState' => 0,
                        'makeTime' => $makeTime,
                        //'auditUserId' => $ao->truckInfo->auditUserId,
                     );
                     $this->common_model->save(TABLE_FREIGHT_SOURCE_HIS, $his);
                }
            }
            
            $result['status'] = 'OK';
            
        }
        $this->output
                ->set_content_type("application/json")
                ->set_output(json_encode($result));
    }

    /*
     *  freightSource.setMakeTime(now);
        freightSource.setCreateUserId(user.getId());
        freightSource.setCreateUserName(user.getUserName());
        fs.setAttention(vo.getAttention());
        fs.setDestCity(vo.getDestCity());
        fs.setDestProvince(vo.getDestProvince());
        fs.setDestRegion(vo.getDestRegion());
        fs.setFreightName(vo.getFreightName());
        fs.setFreightType(vo.getFreightType());
        fs.setFreightVolumn(vo.getFreightVolumn());
        fs.setFreightWeight(vo.getFreightWeight());
        fs.setCreateUserId(user.getId());
        fs.setCreateUserName(user.getUserName());
        fs.setOriginCity(vo.getOriginCity());
        fs.setOriginProvince(vo.getOriginProvince());
        fs.setOriginRegion(vo.getOriginRegion());
        fs.setPackType(vo.getPackType());
 * */
} 