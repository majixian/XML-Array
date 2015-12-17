<?php
/**
 * Created by PhpStorm.
 * User: Mjx
 * Date: 2015/12/17
 * Time: 15:12
 */
include 'Tool/xmlWithArray.php';

class Test{

    public  static $TestXml = '<?xml version="1.0" encoding="utf-8"?>
						     <eaiAhsXml>
							<Header>
								<TRAN_CODE>inputNeed#header-tran_code</TRAN_CODE>
								<BK_ACCT_DATE>inputNeed#header-date</BK_ACCT_DATE>
								<BK_ACCT_TIME>inputNeed#header-time</BK_ACCT_TIME>
								<BK_SERIAL>inputNeed#header-serial</BK_SERIAL>
							</Header>
							<Request>
								<ahsPolicy>
									<policyBaseInfo>
										<applyPersonnelNum>1</applyPersonnelNum>
										<relationshipWithInsured>inputNeed#policy_base_info-relationship</relationshipWithInsured>
										<totalModalPremium>inputNeed#policy_base_info-total_premium</totalModalPremium>
									</policyBaseInfo>
									<insuranceApplicantInfo>
											<personnelName>inputNeed#insure-name</personnelName>
											<certificateType>inputNeed#insure-certificate_type</certificateType>
											<certificateNo>inputNeed#insure-certificate_no</certificateNo>
									</insuranceApplicantInfo>
										<subjectInfo>
											<totalModalPremium>inputNeed#subject_info-total_modal_premium</totalModalPremium>

													<personnelAttribute>100</personnelAttribute>
													<virtualInsuredNum></virtualInsuredNum>
													<personnelName>inputNeed#insured_info-name</personnelName>
													<sexCode>inputNeed#insured_info-sex</sexCode>
													<certificateType>inputNeed#insured_info-certificate_type</certificateType>
													<certificateNo>inputNeed#insured_info-certificate_no</certificateNo>
									</subjectInfo>
								</ahsPolicy>
							</Request>
						</eaiAhsXml>';

    public static function main(){
        //数组
        $array = self::testXml();
        //xml
        $xml = self::testArray($array);
    }

    private static function testXml(){
        $xml = new \XMLReader();
        $xml->XML(self::$TestXml);
        $xmlarray = xmlWithArray::xmlToarray($xml);
        return $xmlarray;
    }

    private static function testArray($array){
        $xml = xmlWithArray::arrayToxml($array,'1.0','utf-8');
        return $xml;
    }
}
Test::main();