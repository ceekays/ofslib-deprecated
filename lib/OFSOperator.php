<?php
/******************************************************************************
 *      OFSOperator.php                                                       *
 *      - Contains OFS Operator definitions                                   *
 *                                                                            *
 *      https://github.com/ceekays/ofslib                                     *
 *                                                                            *
 ******************************************************************************
 *                                                                            *
 *      Created in August 2013                                                *
 *      by Edmond C. Kachale (Malawi)                                         *
 *      (kachaleedmond [at] gmail [dot] com)                                  *
 *                                                                            *
 ******************************************************************************/
class OFSOperator {
    /**
     * a list of OFSOperator types
     */
    const EQ  =	"d92d6b1a-a617-47b1-9b74-a5ede57720b3";
    const GE  =	"5d123f6e-e515-4da4-ab82-0c2591149e08";
    const GT  =	"d1370b05-3d22-4f7b-88e2-d581b67108a1";
    const LE  =	"fc016913-81a5-4460-ad70-517e5b7b31e0";
    const LK  =	"43cd8e60-477f-440b-a9fc-98f8e96c5097";
    const LT  =	"9764fe11-3d87-45fe-8faa-b54f1394a5b6";
    const NE  =	"c362384c-5529-4438-98b1-6984369adb82";
    const NR  =	"97d5478a-ec28-4e73-8946-b4b0fe3ed34c";
    const RG  = "97585a7c-8c44-4541-82b6-e3bec0013e75";
    const UL  = "6c69ddcc-2ec2-4509-939d-88a6e453391c";

    /**
     * a list of the actual operators
     */ 
    private static $_operators = array(
      OFSOperator::EQ  =>	"EQ",
      OFSOperator::GE  =>	"GE",
      OFSOperator::GT  =>	"GT",
      OFSOperator::LE  =>	"LE",
      OFSOperator::LK  =>	"LK",
      OFSOperator::LT  =>	"LT",
      OFSOperator::NE  =>	"NE",
      OFSOperator::NR  =>	"NR",
      OFSOperator::RG  => "RG",
      OFSOperator::UL  => "UL"
    );

  /**
   * Retrieves the value of an operator type
   * @param $operator_type  a valid operator type defined in OFSOperator
   * @returns $operator     an actual operator
   */
    public static function get_value($operator_type){
      $keys = array_keys(self::$_operators);

      if(!in_array($operator_type, array_keys(self::$_operators)))
        throw new OFSException(SyntaxError::UNKNOWN_FIELDS, $operator_type);

      $operator = self::$_operators[$operator_type];
      return $operator;
    }
}
?>
