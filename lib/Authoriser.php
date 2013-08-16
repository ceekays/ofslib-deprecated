<?php
/******************************************************************************
 *      Authoriser.php                                                        *
 *      - Definitions for controlling number of authorisers                   *
 *                                                                            *
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
  class Authoriser{


    /**
     * A list of acceptable number of authorisers
     */
    const ONE_AUTHORISER    = 'ae28c8f0-ae21-4c5d-aef1-e9c384580330';
    const TWO_AUTHORISERS   = 'f89b0962-7fed-4632-aff8-fcde65030d30';
    const USE_DEFAULT       = 'f3c629f2-e427-4bc7-aa0b-fec563b7ee51';
    const ZERO_AUTHORISERS  = '7708ad55-1861-4da4-9b71-bc9e5b561e46';

    /**
     * Aliases for the number of authoriser codes
     */
    const DOUBLE_AUTHORISERS  = Authoriser::TWO_AUTHORISERS;
    const NO_AUTHORISERS      = Authoriser::ZERO_AUTHORISERS;
    const SELF_AUTHORISER     = Authoriser::ZERO_AUTHORISERS;
    const SINGLE_AUTHORISER   = Authoriser::ONE_AUTHORISER;

    /**
     * Holds the actual list of the number of authorisers
     * @var $_authorisers
     */
    private static $_authorisers = array(
      Authoriser::USE_DEFAULT       => '',
      Authoriser::ZERO_AUTHORISERS  => '0',
      Authoriser::ONE_AUTHORISER    => '1',
      Authoriser::TWO_AUTHORISERS   => '2'
    );

  }
?>

