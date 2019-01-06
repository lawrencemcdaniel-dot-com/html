<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
/**
 * Adds A Mortgage Calculator.
 */
 class HappyCat_Plugins_Mortgage_Calc_Widget extends WP_Widget {
    /**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'HappyCat_Plugins_Mortgage_Calc_Widget', // Base ID
			esc_html__( 'A Mortgage Calculator', 'text_domain' ), // Name
			array( 'description' => esc_html__( 'A Quick Widget To Put A Mortgage Calculator On Your Site.', 'text_domain' ), ) // Args
		);
	}


	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */

     public function widget( $args, $instance ) {
        $data = array();
        $data['title'] = apply_filters ( 'widget_title', $instance['title']);
        $data['theme'] = esc_attr($instance['theme']);
        $data['rate'] = esc_attr($instance['rate']);

        /*echo $args['before_widget'];

            if ( ! empty( $title ) ) {
                echo $args['before_title'] . $title . $args['after_title'];
            }*/

            //Show Mortgage
            echo $this->getMortbox($data);

            echo $args['after_widget'];

        }

    /**
    * Back-end widget form.
    *
    * @see WP_Widget::form()
    *
    * @param array $instance Previously saved values from database.
    */
    public function form( $instance ) {
        $this->getHappyCatMortCalcForm($instance);
        }


    /**
        * Sanitize widget form values as they are saved.
        *
        * @see WP_Widget::update()
        *
        * @param array $new_instance Values just sent to be saved.
        * @param array $old_instance Previously saved values from database.
        *
        * @return array Updated safe values to be saved.
    */
        public function update( $new_instance, $old_instance ) {
            $instance = array();
            $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
            $instance['theme'] = ( ! empty( $new_instance['theme'] ) ) ? strip_tags( $new_instance['theme'] ) : '';
            $instance['rate'] = ( ! empty( $new_instance['rate'] ) ) ? strip_tags( $new_instance['rate'] ) : '';

            return $instance;
        }


    /*
        * Get and Display Mortbox
        * @param  array $data
    */
    public function getMortbox($data){
    $output = '
    <div class="happyCatMortCalcDiv '.$data["theme"].'">
        <h2 class="happyCatMortCalcHeading">'.$data["title"].'</h2>
            <form id="happyCatMortCalc">
                <div class="happyCatMortCalc_price">
                    <label for="price">Home Price</label>
                    <input id="happyCalcPriceInput" value="$300,000" class="happyCatMortCalc_price_input">
                </div>
                <div class="happyCatMortCalc_down">
                    <label for="downPayment">Down payment</label>
                    <input id="happyCalcDownInput" value="$60,000" class="happyCatMortCalc_down_input">
                    <input id="happyCalcDownPerInput" value="20" class="happyCatMortCalc_downPer_input">
                    <i>%</i>
                </div>
                <div class="happyCatMortCalc_loan">
                    <label for="loanProgram">Loan Program</label>
                    <select id="happyCalcLoanInput" class="happyCatMortCalc_loan_input">
                        <option selected="selected" value="30">30 Year Fixed</option>
                        <option value="15">15 Year Fixed</option>
                    </select>
                </div>
                <div class="happyCatMortCalc_interestRate">
                    <label for="interestRate">Interest Rate</label>
                    <input id="happyCalcIntRate" value="'.$data["rate"].'" class="happyCatMortCalc_intRate_input">
                    <i>%</i>
                </div>
                <div class="happyCatMortCalc_AdvancedSettings" id="happyCatshowAdvanced">
                    <h4 class="happyCatMortCalc_adText">ADVANCED</h4>
                </div>
                <!--HIDDEN SETTINGS-->
                <div id="happyCatAdvancedDiv" class="happyCatMortCalc_advSettings happyCatMortCalcHidden">
                    <div class="happycatMorgCalcLine"></div>
                    <div class="happyCatMortCalc_tax">
                        <label for="tax">Property Tax</label>
                        <input id="happyCalcTax" value="$1,740" class="happyCatMortCalc_tax_input">
                    </div>
                    <div class="happyCatMortCalc_ins">
                        <label for="tax">Home Insurance</label>
                        <input id="happyCalcIns" value="$800" class="happyCatMortCalc_ins_input">
                    </div>
                    <div class="happyCatMortCalc_hoa">
                        <label for="hoa">Home Owner Association Fees</label>
                        <input id="happyCalcHoa" value="$0" class="happyCatMortCalc_hoa_input">
                    </div>
                    <div class="happyCatMortCalc_SimpleSettings" id="happyCatshowSimple">
                        <h4 class="happyCatMortCalc_simpleText">HIDE ADVANCED</h4>
                    </div>
                </div>
                <div class="happyCatMortCalcResults">
                    <div class="happyCatMortCalc_Total">
                        <h3 class="happyCatMortCalc_TotalText">Your Monthly Total</h3>$<span id="hcreplaceTotal" class="happyCatMorcCalc_TotalNo">1374</span>
                    </div>
                    <div class="happyCatMortCalc_Total_bottom">
                        <div class="happyCatMortCalc_PI">
                            <h4 class="happyCatMortCalc_PIText">P&I</h4>$<span id="hcreplacePI">1,105</span>
                        </div>
                        <div class="happyCatMortCalc_Tax">
                            <h4 class="happyCatMortCalc_TaxText">TAXES & INS</h4>$<span id="hcreplaceTax">287</span>
                        </div>
                    </div>
                </div>
            </form>
        </div>';


        return $output;
    }


    /*
    * Get Backend form
    *
    */
        public function getHappyCatMortCalcForm($instance){
        if (isset( $instance[ 'title' ])) {
            $title = $instance[ 'title' ];
        } else {
            $title = __( 'Simple Mortgage Calculator', 'text_domain' );
        }

        if (isset( $instance[ 'theme' ])) {
            $theme = esc_attr($instance[ 'theme' ]);
        } else {
            $theme = 'happyCatMortCalc01';
        }
        if (isset( $instance[ 'rate' ])) {
            $rate = esc_attr($instance[ 'rate' ]);
        } else {
            $rate = '3.59';
        }
        ?>
        <p>
        <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
        <input class="widefat"
                id="<?php echo $this->get_field_id( 'title' ); ?>"
                name="<?php echo $this->get_field_name( 'title' ); ?>"
                type="text" value="<?php echo esc_attr( $title ); ?>"
        >
        </p>
        <p>
        <label for="<?php echo $this->get_field_id( 'theme' ); ?>"><?php _e( 'What Theme?' ); ?></label>
        <select class="widefat"
                id="<?php echo $this->get_field_id( 'theme' ); ?>"
                name="<?php echo $this->get_field_name( 'theme' ); ?>"
                type="text">
            <option value="happyCatMortTheme01" <?php echo ($theme == 'happyCatMortTheme01')?'selected':''; ?>>Pink</option>
            <option value="happyCatMortTheme02" <?php echo ($theme == 'happyCatMortTheme02')?'selected':''; ?>>Blue</option>
            <option value="happyCatMortTheme03" <?php echo ($theme == 'happyCatMortTheme03')?'selected':''; ?>>Gray</option>
        </select>
        </p>
        <p>
        <label for="<?php echo $this->get_field_id( 'rate' ); ?>"><?php _e( 'Default Interest Rate:' ); ?></label>
        <input class="widefat"
                id="<?php echo $this->get_field_id( 'rate' ); ?>"
                name="<?php echo $this->get_field_name( 'rate' ); ?>"
                type="number" value="<?php echo esc_attr( $rate ); ?>"
                max="15"
                min="1"
        >
        </p>

        <?php
        }

} //class Mortgage_Widget
