<?php
class Page extends SiteTree {

	private static $db = array(
	);

	private static $has_one = array(
	);

}
class Page_Controller extends ContentController {

	/**
	 * An array of actions that can be accessed via a request. Each array element should be an action name, and the
	 * permissions or conditions required to allow the user to access it.
	 *
	 * <code>
	 * array (
	 *     'action', // anyone can access this action
	 *     'action' => true, // same as above
	 *     'action' => 'ADMIN', // you must have ADMIN permissions to access this action
	 *     'action' => '->checkAction' // you can only access this action if $this->checkAction() returns true
	 * );
	 * </code>
	 *
	 * @var array
	 */
	private static $allowed_actions = array (
	);

	public function init() {
		parent::init();
		// You can include any CSS or JS required by your project here.
		// See: http://doc.silverstripe.org/framework/en/reference/requirements
		Requirements::css("{$this->ThemeDir()}/css/bootstrap.min.css");
		Requirements::css("{$this->ThemeDir()}/css/bootstrap-theme.min.css");
		Requirements::css("{$this->ThemeDir()}/css/buttonstyle.css");
		Requirements::css("{$this->ThemeDir()}/css/navbar.css");
		Requirements::css("{$this->ThemeDir()}/css/mainlayout.css");
//		Requirements::css("{$this->ThemeDir()}/css/transition.css");
		
		Requirements::javascript("{$this->ThemeDir()}/js/jquery-1.9.1.min.js");
		Requirements::javascript("{$this->ThemeDir()}/js/bootstrap.min.js");
		//Requirements::javascript("{$this->ThemeDir()}/js/sitevalidator.js");
		
		Requirements::javascript("{$this->ThemeDir()}/js/dogetpdf.js");
		Requirements::javascript("{$this->ThemeDir()}/js/star-rating.js");
		
	}

}
