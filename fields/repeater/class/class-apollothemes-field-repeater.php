<?php
// Exit if accessed directly
if (!defined('ABSPATH')) {
	exit;
}

if (!class_exists('WP_Customize_Control')) {
	return null;
}

if (!class_exists('Apollothemes_Field_Repeater')) {
	class Apollothemes_Field_Repeater extends WP_Customize_Control {

		public $type            = 'apollothemes-repeater';
		public $fields          = array();
		public $row_label       = '';
		private $icon_container = '';


		/**
		 * Class constructor
		 */
		public function __construct($manager, $id, $args = array()) {
			parent::__construct($manager, $id, $args);

			$this->icon_container = trailingslashit(BLAZING_COMPANION_DIR) . 'fields/repeater/inc/icons.php';

		}

		public function enqueue() {
			wp_enqueue_style('font-awesome', BLAZING_COMPANION_URI . 'fields/repeater/css/font-awesome.min.css');
			wp_enqueue_style('apollothemes-iconpicker', BLAZING_COMPANION_URI . 'fields/repeater/css/apollothemes-iconpicker.css');
			wp_enqueue_style('apollothemes-repeater', BLAZING_COMPANION_URI . 'fields/repeater/css/apollothemes-repeater.css');

			wp_enqueue_script('apollothemes-field-repeater', BLAZING_COMPANION_URI . 'fields/repeater/js/apollothemes-field-repeater.js', array('jquery', 'jquery-ui-sortable', 'jquery-ui-draggable', 'wp-color-picker'), BLAZING_COMPANION_VAR, true);
			wp_enqueue_script('apollothemes-iconpicker', BLAZING_COMPANION_URI . 'fields/repeater/js/apollothemes-iconpicker.js', array('jquery'), BLAZING_COMPANION_VAR, true);
		}

		public function render_content() {
			if (empty($this->fields)) {
				return;
			}

			$fields  = $this->fields;
			$values  = $this->value();
			if(!is_array($values)){
				$values  = json_decode($values, true);
			}
			$fields  = $this->fields;
			

			?>

			<?php if (!empty($this->label)): ?>
				<span class="customize-control-title"><?php echo esc_html($this->label); ?></span>
			<?php endif;?>

			<?php if (!empty($this->description)): ?>
				<span class="description customize-control-description"><?php echo $this->description; ?></span>
			<?php endif;?>
			<ul class="apollothemes-repeater-copy" style="display: none !important;">
				<li class="apollothemes-repeater-item-copy">
					<div class="apollothemes-repeater-contaier">
						<div class="repeater-head">
							<i class="dashicons dashicons-menu"></i>
							<label class="repeater-label"><span class="lable"><?php echo esc_html($this->row_label); ?></span> <span class="index"></span> </label>
							<i class="dashicons dashicons-arrow-right"></i>
						</div>
						<div class="repeater-body">
							<?php foreach ($fields as $key => $field): ?>
							<div class="repeater-element">
								<?php if (isset($field['label'])): ?>
								<label><?php echo esc_html($field['label']); ?></label>
								<?php endif;?>
								<?php $this->get_field($field, $key);?>
								<?php if(isset($field['description'])): ?>
									<span class="description"><?php echo esc_html($field['description']); ?></span>
								<?php endif; ?>
							</div>
							<?php endforeach;?>
							<button type="button" class="apt-remove-button apollothemes-repeater-remove-item"><?php esc_html_e('Remove Field', 'blazing-companion');?></button>
						</div>
					</div>
				</li>
			</ul>
			<ul class="apollothemes-repeater">
				<?php $i = 1;?>
				<input class="apollothemes-customize-setting-link apollothemes-repeater-data" id="apollothemes-shortable-data-<?php echo esc_attr($this->id); ?>" type="hidden"  value <?php $this->link();?>>
				<?php if ($values): foreach ($values as $key => $value): ?>
						<li class="apollothemes-repeater-item">
							<div class="apollothemes-repeater-contaier">
								<div class="repeater-head">
									<i class="dashicons dashicons-menu"></i>
									<label class="repeater-label"><span class="lable"><?php echo esc_html($this->row_label); ?></span> <span class="index"><?php echo esc_html($i); ?></span> </label>
									<i class="dashicons dashicons-arrow-right"></i>
								</div>
								<div class="repeater-body">
									<?php foreach ($fields as $key => $field): ?>
									<div class="repeater-element">
										<?php if (isset($field['label'])): ?>
										<label><?php echo esc_html($field['label']); ?></label>
										<?php endif;?>
										<?php
											$field_value = isset($value[$key]) ? $value[$key] : '';
											$this->get_field($field, $key, $field_value);
										?>
										<?php if(isset($field['description'])): ?>
											<span class="description"><?php echo esc_html($field['description']); ?></span>
										<?php endif; ?>
									</div>
									<?php endforeach;?>
									<button type="button" class="apt-remove-button apollothemes-repeater-remove-item"><?php esc_html_e('Remove Field', 'blazing-companion');?></button>
								</div>
							</div>
						</li>
				<?php $i++;endforeach;endif;?>
			</ul>
			<button type="button" class="button button-secondary apollothemes-repeater-add-new"><?php printf("%s %s", esc_html_e("Add New", 'blazing-companion'), $this->row_label);?></button>
			<?php

		}

		// return html
		private function get_field($field = array(), $key = '', $value = '') {
			if (empty($field)) {
				return;
			}
			$type = '';

			if (isset($field['type'])) {
				$type = $field['type'];
			}
			if (empty($value) && isset($field['default']) && $type !== 'repeater') {
				$value = $field['default'];
			}

			switch ($type) {
			case 'text':
				?> <input type="text" class="widefat apollothemes-repeater-field" data-apt-index="<?php echo esc_attr($key); ?>" value="<?php echo esc_attr($value); ?>"> <?php
				break;

			case 'textarea':
				?><textarea class="widefat apollothemes-repeater-field" data-apt-index="<?php echo esc_attr($key); ?>"><?php echo wp_kses_post($value); ?></textarea><?php
				break;

			case 'image':
				?>
					<input type="text" class="widefat image-select-field apollothemes-repeater-field" data-apt-index="<?php echo esc_attr($key); ?>" value="<?php echo esc_url($value); ?>">
					<button type="button" class="button button-secondary image-select-button"><?php esc_html_e('Select Image', 'blazing-companion')?></button>
					<?php
				break;

			case 'icon':
				?>
					<div class="icon-field-group">
						<span class="apt-rep-icon">
							<span class="icon-show"><i class="fa <?php echo esc_attr($value); ?>"></i></span>
							<input type="text" class="widefat icon-select-field apollothemes-repeater-field" data-apt-index="<?php echo esc_attr($key); ?>" value="<?php echo esc_attr($value); ?>">
						</span>
						<?php
							if (file_exists($this->icon_container)) {
								include $this->icon_container;
							}
						?>
					</div>
					<?php
						break;

			case 'dropdown-pages':

				$pages = get_pages(array('hide_empty' => false));
				if (!empty($pages)): ?>
		              	<select class="widefat apollothemes-repeater-field" data-apt-index="<?php echo esc_attr($key); ?>">
			                <option value="0"><?php esc_html_e('Select Page', 'blazing-companion');?></option>
			              	<?php
								foreach ($pages as $page):
									printf('<option value="%s" %s>%s</option>',
										$page->ID,
										selected($value, $page->ID, false),
										$page->post_title
									);
								endforeach;
							?>
		              	</select>
		            <?php endif;
				break;

			case 'repeater':
				?>
					<div class="apollothemes-repeater-repeater-copy" style="display: none !important;">
						<div class="apollothemes-repeater-repeater-group-copy">
							<div class="apollothemes-repeater-repeater-element">
								<div class="icon-field-group">
									<span>
										<span class="icon-show"><i class="fa"></i></span>
										<input type="text" class="widefat icon-select-field apollothemes-repeater-repeater-field" data-apt-index="icon" value="">
									</span>
									<?php
										if (file_exists($this->icon_container)) {
											include $this->icon_container;
										}
									?>
								</div>
							</div>
							<div class="apollothemes-repeater-repeater-element">
								<input type="text" class="widefat apollothemes-repeater-repeater-field" data-apt-index="link" value="">
							</div>
							<button type="button" class="apt-remove-button apollothemes-repeater-remove-repeater"><?php esc_html_e('Remove Icon', 'blazing-companion');?></button>
						</div>
					</div>
					<div class="apollothemes-repeater-repeater">
						<?php if (!empty($value)): foreach ($value as $ikey => $item): ?>
								<div class="apollothemes-repeater-repeater-group">
									<div class="apollothemes-repeater-repeater-element">
										<div class="icon-field-group">
											<span>
												<span class="icon-show"><i class="fa <?php echo esc_attr($item['icon']); ?>"></i></span>
												<input type="text" class="widefat icon-select-field apollothemes-repeater-repeater-field" data-apt-index="icon" value="<?php echo esc_attr($item['icon']); ?>">
											</span>
											<?php
												if (file_exists($this->icon_container)) {
													include $this->icon_container;
												}
											?>
										</div>
									</div>
									<div class="apollothemes-repeater-repeater-element">
										<input type="text" class="widefat apollothemes-repeater-repeater-field" data-apt-index="link" value="<?php echo esc_attr($item['link']); ?>">
									</div>
									<button type="button" class="apt-remove-button apollothemes-repeater-remove-repeater"><?php esc_html_e('Remove Icon', 'blazing-companion');?></button>
								</div>
								<?php endforeach;endif;?>
								<?php $button_label = (isset($value['button_label'])) ? $value['button_label'] : __('Add Icon', 'blazing-companion');?>
								<button type="button" class="button button-secondary apollothemes-repeater-add-repeater"><?php echo esc_html($button_label); ?></button>
					</div>
					<?php
					break;

			default:
				?> <input type="text" class="widefat apollothemes-repeater-field" data-apt-index="<?php echo esc_attr($key); ?>" value="<?php echo esc_attr($value); ?>"> <?php
			break;
			}
		}
	}
}