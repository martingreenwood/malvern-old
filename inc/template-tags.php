<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package malvern
 */

if ( ! function_exists( 'malvern_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	function malvern_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = sprintf(
			/* translators: %s: post date. */
			esc_html_x( 'Posted on %s', 'post date', 'malvern' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		$byline = sprintf(
			/* translators: %s: post author. */
			esc_html_x( 'by %s', 'post author', 'malvern' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

	}
endif;

if ( ! function_exists( 'malvern_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function malvern_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', 'malvern' ) );
			if ( $categories_list ) {
				/* translators: 1: list of categories. */
				printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'malvern' ) . '</span>', $categories_list ); // WPCS: XSS OK.
			}

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'malvern' ) );
			if ( $tags_list ) {
				/* translators: 1: list of tags. */
				printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'malvern' ) . '</span>', $tags_list ); // WPCS: XSS OK.
			}
		}

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link(
				sprintf(
					wp_kses(
						/* translators: %s: post title */
						__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'malvern' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				)
			);
			echo '</span>';
		}

		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'malvern' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
endif;

if ( ! function_exists( 'malvern_post_thumbnail' ) ) :
/**
 * Displays an optional post thumbnail.
 *
 * Wraps the post thumbnail in an anchor element on index views, or a div
 * element when on single views.
 */
function malvern_post_thumbnail() {
	if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
		return;
	}

	if ( is_singular() ) :
	?>

	<div class="post-thumbnail">
		<?php the_post_thumbnail(); ?>
	</div><!-- .post-thumbnail -->

	<?php else : ?>

	<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true">
		<?php
			the_post_thumbnail( 'post-thumbnail', array(
				'alt' => the_title_attribute( array(
					'echo' => false,
				) ),
			) );
		?>
	</a>

	<?php endif; // End is_singular().
}
endif;

/**
 * Twitter style dates
 */
function ShowDate($date) // $date --> time(); value
{
	$stf = 0;
	$cur_time = time();
	$diff = $cur_time - $date;
	$phrase = array('second','minute','hour','day','week','month','year','decade');
	$length = array(1,60,3600,86400,604800,2630880,31570560,315705600);
	for($i =sizeof($length)-1; ($i>=0) &&(($no = $diff/$length[$i])<=1); $i--);  if($i<0) $i=0; $_time = $cur_time -($diff%$length[$i]);
	$no = floor($no); if($no>1) $phrase[$i] .='s'; $value=sprintf("%d %s ",$no,$phrase[$i]);
	if(($stf == 1) &&($i>= 1) &&(($cur_tm-$_time)>0)) $value .= time_ago($_time);
	return $value.' ago ';
} 

/**
 * Page Tree
 */
function is_tree($pid) {      // $pid = The ID of the page we're looking for pages underneath
	global $post;         // load details about this page
	if(is_page()&&($post->post_parent==$pid||is_page($pid))) 
		return true;   // we're at the page or at a sub page
	else 
		return false;  // we're elsewhere
}

/**
 * Options
 */
if( function_exists('acf_add_options_page') ) {
 
	$option_page = acf_add_options_page(array(
		'page_title' 	=> 'NSSO Options',
		'menu_title' 	=> 'NSSO Options',
		'menu_slug' 	=> 'nsso-options',
		'capability' 	=> 'edit_posts',
		'redirect' 		=> false
	));
 
}

/**
 * Custom Post Typs
 */
function staff_cpt() {
	register_post_type( 'team',
		array(
			'labels' => array(
				'name' => __( 'Team Members' ),
				'singular_name' => __( 'Team Member' )
			),
			'public' => true,
			'has_archive' => false,
			'supports' => array('title', 'editor', 'thumbnail'),
		)
	);
}
add_action( 'init', 'staff_cpt' );

function staff_cpt_taxonomies() {
    register_taxonomy(
        'team_type',
        'team',
        array(
            'labels' => array(
                'name' => 'Team Type',
                'add_new_item' => 'Add Team Type',
                'new_item_name' => "New Team Type"
            ),
            'show_ui' => true,
            'show_tagcloud' => false,
            'hierarchical' => true
        )
    );
}
add_action( 'init', 'staff_cpt_taxonomies', 0 );


function my_acf_init() {
	
	acf_update_setting('google_api_key', 'AIzaSyDxP3OTTogYZecLv64jOhYRh4ZLHm28wqg');
}

add_action('acf/init', 'my_acf_init');



add_action( 'show_user_profile', 'extra_user_profile_fields' );
add_action( 'edit_user_profile', 'extra_user_profile_fields' );

function extra_user_profile_fields( $user ) { ?>
    <h3><?php _e("Personal Information", "blank"); ?></h3>

    <table class="form-table">
    <tr>
        <th><label for="addressline1"><?php _e("Address Line 1"); ?></label></th>
        <td>
            <input type="text" name="addressline1" id="addressline1" value="<?php echo esc_attr( get_the_author_meta( 'addressline1', $user->ID ) ); ?>" class="regular-text" /><br />
            <span class="description"><?php _e("Please enter the first line of your address."); ?></span>
        </td>
    </tr>
    <tr>
        <th><label for="addressline2"><?php _e("Address Line 2"); ?></label></th>
        <td>
            <input type="text" name="addressline2" id="addressline2" value="<?php echo esc_attr( get_the_author_meta( 'addressline2', $user->ID ) ); ?>" class="regular-text" /><br />
            <span class="description"><?php _e("Please enter the seconc line of your address."); ?></span>
        </td>
    </tr>
    <tr>
        <th><label for="city"><?php _e("City"); ?></label></th>
        <td>
            <input type="text" name="city" id="city" value="<?php echo esc_attr( get_the_author_meta( 'city', $user->ID ) ); ?>" class="regular-text" /><br />
            <span class="description"><?php _e("Please enter your city."); ?></span>
        </td>
    </tr>
    <tr>
        <th><label for="county"><?php _e("County"); ?></label></th>
        <td>
            <input type="text" name="county" id="county" value="<?php echo esc_attr( get_the_author_meta( 'county', $user->ID ) ); ?>" class="regular-text" /><br />
            <span class="description"><?php _e("Please enter your county."); ?></span>
        </td>
    </tr>
    <tr>
        <th><label for="postcode"><?php _e("Postcode"); ?></label></th>
        <td>
            <input type="text" name="postcode" id="postcode" value="<?php echo esc_attr( get_the_author_meta( 'postcode', $user->ID ) ); ?>" class="regular-text" /><br />
            <span class="description"><?php _e("Please enter your postcode."); ?></span>
        </td>
    </tr>
    <tr>
        <th><label for="homephone"><?php _e("Home Phone"); ?></label></th>
        <td>
            <input type="text" name="homephone" id="homephone" value="<?php echo esc_attr( get_the_author_meta( 'homephone', $user->ID ) ); ?>" class="regular-text" /><br />
            <span class="description"><?php _e("Please enter your home phone."); ?></span>
        </td>
    </tr>
    <tr>
        <th><label for="mobile"><?php _e("Mobile"); ?></label></th>
        <td>
            <input type="text" name="mobile" id="mobile" value="<?php echo esc_attr( get_the_author_meta( 'mobile', $user->ID ) ); ?>" class="regular-text" /><br />
            <span class="description"><?php _e("Please enter your mobile."); ?></span>
        </td>
    </tr>
    <tr>
    <th><label for="childsname"><?php _e("Childs Name"); ?></label></th>
        <td>
            <input type="text" name="childsname" id="childsname" value="<?php echo esc_attr( get_the_author_meta( 'childsname', $user->ID ) ); ?>" class="regular-text" /><br />
            <span class="description"><?php _e("Please enter your childs name."); ?></span>
        </td>
    </tr>
    <tr>
    <th><label for="dob"><?php _e("Date of Birth"); ?></label></th>
        <td>
            <input type="text" name="dob" id="dob" value="<?php echo esc_attr( get_the_author_meta( 'dob', $user->ID ) ); ?>" class="regular-text" /><br />
            <span class="description"><?php _e("Please enter your childs date of birth."); ?></span>
        </td>
    </tr>
    <tr>
    <th><label for="schoolyear"><?php _e("School Year"); ?></label></th>
        <td>
            <input type="text" name="schoolyear" id="schoolyear" value="<?php echo esc_attr( get_the_author_meta( 'schoolyear', $user->ID ) ); ?>" class="regular-text" /><br />
            <span class="description"><?php _e("Please enter your childs school year."); ?></span>
        </td>
    </tr>
    <tr>
    <th><label for="gender"><?php _e("Gender"); ?></label></th>
        <td>
            <input type="text" name="gender" id="gender" value="<?php echo esc_attr( get_the_author_meta( 'gender', $user->ID ) ); ?>" class="regular-text" /><br />
            <span class="description"><?php _e("Please enter your childs gender."); ?></span>
        </td>
    </tr>
    <tr>
    <th><label for="schoolattended"><?php _e("School Attended"); ?></label></th>
        <td>
            <input type="text" name="schoolattended" id="schoolattended" value="<?php echo esc_attr( get_the_author_meta( 'schoolattended', $user->ID ) ); ?>" class="regular-text" /><br />
            <span class="description"><?php _e("Please enter your childs school attended."); ?></span>
        </td>
    </tr>
    <tr>
    <th><label for="headteacher"><?php _e("Head Teacher"); ?></label></th>
        <td>
            <input type="text" name="headteacher" id="headteacher" value="<?php echo esc_attr( get_the_author_meta( 'headteacher', $user->ID ) ); ?>" class="regular-text" /><br />
            <span class="description"><?php _e("Please enter your childs head teacher."); ?></span>
        </td>
    </tr>
    <tr>
    <th><label for="headteacheremail"><?php _e("Head Teacher Email"); ?></label></th>
        <td>
            <input type="text" name="headteacheremail" id="headteacheremail" value="<?php echo esc_attr( get_the_author_meta( 'headteacheremail', $user->ID ) ); ?>" class="regular-text" /><br />
            <span class="description"><?php _e("Please enter your childs head teacher email."); ?></span>
        </td>
    </tr>
    <tr>
    <th><label for="headofmusic"><?php _e("Head of Music"); ?></label></th>
        <td>
            <input type="text" name="headofmusic" id="headofmusic" value="<?php echo esc_attr( get_the_author_meta( 'headofmusic', $user->ID ) ); ?>" class="regular-text" /><br />
            <span class="description"><?php _e("Please enter your childs head of music."); ?></span>
        </td>
    </tr>
    <tr>
    <th><label for="headofmusicemail"><?php _e("Head of Music Email"); ?></label></th>
        <td>
            <input type="text" name="headofmusicemail" id="headofmusicemail" value="<?php echo esc_attr( get_the_author_meta( 'headofmusicemail', $user->ID ) ); ?>" class="regular-text" /><br />
            <span class="description"><?php _e("Please enter your childs head of music email."); ?></span>
        </td>
    </tr>
    <tr>
    <th><label for="instrumentalteacher"><?php _e("Instrumental Teacer"); ?></label></th>
        <td>
            <input type="text" name="instrumentalteacher" id="instrumentalteacher" value="<?php echo esc_attr( get_the_author_meta( 'instrumentalteacher', $user->ID ) ); ?>" class="regular-text" /><br />
            <span class="description"><?php _e("Please enter your childs instrumental teacher."); ?></span>
        </td>
    </tr>
    <tr>
    <th><label for="instrumentalteacheremail"><?php _e("Instrumental Teacer Email"); ?></label></th>
        <td>
            <input type="text" name="instrumentalteacheremail" id="instrumentalteacheremail" value="<?php echo esc_attr( get_the_author_meta( 'instrumentalteacheremail', $user->ID ) ); ?>" class="regular-text" /><br />
            <span class="description"><?php _e("Please enter your childs instrumental teacher email."); ?></span>
        </td>
    </tr>
    <tr>
    <th><label for="maininstrument"><?php _e("Main Instrument"); ?></label></th>
        <td>
            <input type="text" name="maininstrument" id="maininstrument" value="<?php echo esc_attr( get_the_author_meta( 'maininstrument', $user->ID ) ); ?>" class="regular-text" /><br />
            <span class="description"><?php _e("Please enter your childs main instrument."); ?></span>
        </td>
    </tr>
    <tr>
    <th><label for="lastgradetaken"><?php _e("Last Grade Taken"); ?></label></th>
        <td>
            <input type="text" name="lastgradetaken" id="lastgradetaken" value="<?php echo esc_attr( get_the_author_meta( 'lastgradetaken', $user->ID ) ); ?>" class="regular-text" /><br />
            <span class="description"><?php _e("Please enter your childs last grade taken."); ?></span>
        </td>
    </tr>
    <tr>
    <th><label for="dateofexam"><?php _e("Date of Ecam"); ?></label></th>
        <td>
            <input type="text" name="dateofexam" id="dateofexam" value="<?php echo esc_attr( get_the_author_meta( 'dateofexam', $user->ID ) ); ?>" class="regular-text" /><br />
            <span class="description"><?php _e("Please enter your childs date of exam."); ?></span>
        </td>
    </tr>
    <tr>
    <th><label for="result"><?php _e("Date of Ecam"); ?></label></th>
        <td>
            <input type="text" name="result" id="result" value="<?php echo esc_attr( get_the_author_meta( 'result', $user->ID ) ); ?>" class="regular-text" /><br />
            <span class="description"><?php _e("Please enter your childs result."); ?></span>
        </td>
    </tr>
    <tr>
    <th><label for="currentstandard"><?php _e("Current Standard"); ?></label></th>
        <td>
            <input type="text" name="currentstandard" id="currentstandard" value="<?php echo esc_attr( get_the_author_meta( 'currentstandard', $user->ID ) ); ?>" class="regular-text" /><br />
            <span class="description"><?php _e("Please enter your childs current standard."); ?></span>
        </td>
    </tr>
    <th><label for="additionalinstruments"><?php _e("Additional Instruemnts"); ?></label></th>
        <td>
        	<textarea name="additionalinstruments" id="additionalinstruments" class="regular-text"><?php echo esc_attr( get_the_author_meta( 'additionalinstruments', $user->ID ) ); ?></textarea>
        	<br />
            <span class="description"><?php _e("Please enter your childs additional instruments."); ?></span>
        </td>
    </tr>
    <tr>
    <th><label for="orchestralexp"><?php _e("Recent Orchestral Experience"); ?></label></th>
        <td>
        	<textarea name="orchestralexp" id="orchestralexp" class="regular-text"><?php echo esc_attr( get_the_author_meta( 'orchestralexp', $user->ID ) ); ?></textarea>
        	<br />
            <span class="description"><?php _e("Please enter your childs orchestral experience."); ?></span>
        </td>
    </tr>
    </table>
<?php 
}


add_action( 'personal_options_update', 'save_extra_user_profile_fields' );
add_action( 'edit_user_profile_update', 'save_extra_user_profile_fields' );

function save_extra_user_profile_fields( $user_id ) {
	if ( !current_user_can( 'edit_user', $user_id ) ) { 
		return false; 
	}
	update_user_meta( $user_id, 'homephone', $_POST['homephone'] );
	update_user_meta( $user_id, 'mobile', $_POST['mobile'] );
	update_user_meta( $user_id, 'childsname', $_POST['childsname'] );
	update_user_meta( $user_id, 'dob', $_POST['dob'] );
	update_user_meta( $user_id, 'schoolyear', $_POST['schoolyear'] );
	update_user_meta( $user_id, 'gender', $_POST['gender'] ); 
	update_user_meta( $user_id, 'schoolattended', $_POST['schoolattended'] ); 
	update_user_meta( $user_id, 'headteacher', $_POST['headteacher'] ); 
	update_user_meta( $user_id, 'headteacheremail', $_POST['headteacheremail'] ); 
	update_user_meta( $user_id, 'headofmusic', $_POST['headofmusic'] ); 
	update_user_meta( $user_id, 'headofmusicemail', $_POST['headofmusicemail'] ); 
	update_user_meta( $user_id, 'instrumentalteacher', $_POST['instrumentalteacher'] ); 
	update_user_meta( $user_id, 'instrumentalteacheremail', $_POST['instrumentalteacheremail'] ); 
	update_user_meta( $user_id, 'maininstrument', $_POST['maininstrument'] ); 
	update_user_meta( $user_id, 'lastgradetaken', $_POST['lastgradetaken'] ); 
	update_user_meta( $user_id, 'result', $_POST['result'] ); 
	update_user_meta( $user_id, 'dateofexam', $_POST['dateofexam'] ); 
	update_user_meta( $user_id, 'currentstandard', $_POST['currentstandard'] ); 
	update_user_meta( $user_id, 'additionalinstruments', $_POST['additionalinstruments'] ); 
	update_user_meta( $user_id, 'orchestralexp', $_POST['orchestralexp'] );

	update_user_meta( $user_id, 'addressline1', $_POST['addressline1'] );
	update_user_meta( $user_id, 'addressline2', $_POST['addressline2'] );
	update_user_meta( $user_id, 'city', $_POST['city'] );
	update_user_meta( $user_id, 'county', $_POST['county'] );
	update_user_meta( $user_id, 'postcode', $_POST['postcode'] );
}

/**
* Gravity Wiz // Gravity Forms // Multi-page Form Navigation
*
* Adds support for navigating between form pages by converting the page steps into page links or creating your own custom page links.
*
* @version   2.0
* @author    David Smith <david@gravitywiz.com>
* @license   GPL-2.0+
* @link      https://gravitywiz.com/multi-page-navigation/
*/
class GWMultipageNavigation {
    public $_args = array();
    private static $script_displayed;
    private static $non_global_forms = array();
    function __construct( $args = array() ) {
        // set our default arguments, parse against the provided arguments, and store for use throughout the class
        $this->_args = wp_parse_args( $args, array(
            'form_id' => false,
            'form_ids' => false,
            'activate_on_last_page' => true
        ) );
        if( $this->_args['form_ids'] ) {
            $form_ids = $this->_args['form_ids'];
        } else if( $this->_args['form_id'] ) {
            $form_ids = $this->_args['form_id'];
        } else {
            $form_ids = array();
        }
        $this->_args['form_ids'] = is_array( $form_ids ) ? $form_ids : array( $form_ids );
        if( ! empty( $this->_args['form_ids'] ) )
            self::$non_global_forms = array_merge( self::$non_global_forms, $this->_args['form_ids'] );
        add_filter( 'gform_pre_render', array( $this, 'output_navigation_script' ), 10, 2 );
    }
    function output_navigation_script( $form, $is_ajax ) {
        // only apply this to multi-page forms
        if( count($form['pagination']['pages']) <= 1 )
            return $form;
        if( ! $this->is_applicable_form( $form['id'] ) )
            return $form;
        $this->register_script( $form );
        if( ! $this->_args['activate_on_last_page'] || $this->is_last_page( $form ) || $this->is_last_page_reached() ) {
            $input = '<input id="gw_last_page_reached" name="gw_last_page_reached" value="1" type="hidden" />';
            add_filter( "gform_form_tag_{$form['id']}", create_function('$a', 'return $a . \'' . $input . '\';' ) );
        }
        // only output the gwmpn object once regardless of how many forms are being displayed
        // also do not output again on ajax submissions
        if( self::$script_displayed || ( $is_ajax && rgpost('gform_submit') ))
            return $form;
        ?>

        <script type="text/javascript">
            (function($){
                window.gwmpnObj = function( args ) {
                    this.formId = args.formId;
                    this.formElem = jQuery('form#gform_' + this.formId);
                    this.currentPage = args.currentPage;
                    this.lastPage = args.lastPage;
                    this.activateOnLastPage = args.activateOnLastPage;
                    this.labels = args.labels;
                    this.init = function() {
                        // if this form is ajax-enabled, we'll need to get the current page via JS
                        if( this.isAjax() )
                            this.currentPage = this.getCurrentPage();
                        if( !this.isLastPage() && !this.isLastPageReached() )
                            return;
                        var gwmpn = this;
                        var steps = $('form#gform_' + this.formId + ' .gf_step');
                        steps.each(function(){
                            var stepNumber = parseInt( $(this).find('span.gf_step_number').text() );
                            if( stepNumber != gwmpn.currentPage ) {
                                $(this).html( gwmpn.createPageLink( stepNumber, $(this).html() ) )
                                    .addClass('gw-step-linked');
                            } else {
                                $(this).addClass('gw-step-current');
                            }
                        });
                        if( !this.isLastPage() && this.activateOnLastPage )
                            this.addBackToLastPageButton();
                        $(document).on('click', '#gform_' + this.formId + ' a.gwmpn-page-link', function(event){
                            event.preventDefault();
                            var hrefArray = $(this).attr('href').split('#');
                            if( hrefArray.length >= 2 ) {
                                var pageNumber = hrefArray.pop();
                                gwmpn.postToPage( pageNumber, ! $( this ).hasClass( 'gwmp-default' ) );
                            }
                        });
                    }
                    this.createPageLink = function( stepNumber, HTML ) {
                        return '<a href="#' + stepNumber + '" class="gwmpn-page-link gwmpn-default">' + HTML + '</a>';
                    }
                    this.postToPage = function( page ) {
                        this.formElem.append('<input type="hidden" name="gw_page_change" value="1" />');
                        this.formElem.find( 'input[name="gform_target_page_number_' + this.formId + '"]' ).val( page );
                        this.formElem.submit();
                    }
                    this.addBackToLastPageButton = function() {
                        this.formElem.find('#gform_page_' + this.formId + '_' + this.currentPage + ' .gform_page_footer')
                            .append('<input type="button" onclick="gwmpn.postToPage(' + this.lastPage + ')" value="' + this.labels.lastPageButton + '" class="button gform_last_page_button">');
                    }
                    this.getCurrentPage = function() {
                        return this.formElem.find( 'input#gform_source_page_number_' + this.formId ).val();
                    }
                    this.isLastPage = function() {
                        return this.currentPage >= this.lastPage;
                    }
                    this.isLastPageReached = function() {
                        return this.formElem.find('input[name="gw_last_page_reached"]').val() == true;
                    }
                    this.isAjax = function() {
                        return this.formElem.attr('target') == 'gform_ajax_frame_' + this.formId;
                    }
                    this.init();
                }
            })(jQuery);
        </script>

        <?php
        self::$script_displayed = true;
        return $form;
    }
    function register_script( $form ) {
        $page_number = GFFormDisplay::get_current_page($form['id']);
        $last_page = count($form['pagination']['pages']);
        $args = array(
            'formId' => $form['id'],
            'currentPage' => $page_number,
            'lastPage' => $last_page,
            'activateOnLastPage' => $this->_args['activate_on_last_page'],
            'labels' => array(
                'lastPageButton' => __( 'Back to Last Page' )
            )
        );
        $script = "window.gwmpn = new gwmpnObj(" . json_encode( $args ) . ");";
        GFFormDisplay::add_init_script( $form['id'], 'gwmpn', GFFormDisplay::ON_PAGE_RENDER, $script );
    }
    function is_last_page( $form ) {
        $page_number = GFFormDisplay::get_current_page($form['id']);
        $last_page = count($form['pagination']['pages']);
        return $page_number >= $last_page;
    }
    function is_last_page_reached() {
        return rgpost('gw_last_page_reached');
    }
    function is_applicable_form( $form_id ) {
        $is_global_form = ! in_array( $form_id, self::$non_global_forms );
        $is_current_non_global_form = ! $is_global_form && in_array( $form_id, $this->_args['form_ids'] );
        return $is_global_form || $is_current_non_global_form;
    }
}


add_filter('wp_nav_menu_items', 'add_login_logout_link', 10, 2);
function add_login_logout_link($items, $args) {
	ob_start();
	wp_loginout( $_SERVER['REQUEST_URI'] );
	$loginoutlink = ob_get_contents();
	ob_end_clean();
	$items .= '<li>'. $loginoutlink .'</li>';
	return $items;  
}