<?php

/**
 * Job dashboard shortcode content.
 *
 * This template can be overridden by copying it to yourtheme/job_manager/job-dashboard.php.
 *
 * @see         https://wpjobmanager.com/document/template-overrides/
 * @author      Automattic
 * @package     wp-job-manager
 * @category    Template
 * @version     1.35.2
 *
 * @since 1.34.4 Available job actions are passed in an array (`$job_actions`, keyed by job ID) and not generated in the template.
 * @since 1.35.0 Switched to new date functions.
 *
 * @var array     $job_dashboard_columns Array of the columns to show on the job dashboard page.
 * @var int       $max_num_pages         Maximum number of pages
 * @var WP_Post[] $jobs                  Array of job post results.
 * @var array     $job_actions           Array of actions available for each job.
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

$submission_limit            = get_option('job_manager_submission_limit');
$submit_job_form_page_id    = get_option('job_manager_submit_job_form_page_id');
?>
<div id="job-manager-job-dashboard">
    <p><?php esc_html_e('Your listings are shown in the table below.', 'wp-job-manager'); ?></p>
    <table class="job-manager-jobs">
        <thead>
            <tr>
                <?php foreach ($job_dashboard_columns as $key => $column) : ?>
                    <th class="<?php echo esc_attr($key); ?>"><?php echo esc_html($column); ?></th>
                <?php endforeach; ?>
            </tr>
        </thead>
        <tbody>
            <?php if (!$jobs) : ?>
                <tr>
                    <td colspan="<?php echo intval(count($job_dashboard_columns)); ?>">
                        <?php esc_html_e('You do not have any active listings.', 'wp-job-manager'); ?></td>
                </tr>
            <?php else : ?>
                <?php foreach ($jobs as $job) : ?>
                    <tr>
                        <?php foreach ($job_dashboard_columns as $key => $column) : ?>
                            <td class="<?php echo esc_attr($key); ?>">
                                <?php if ('job_title' === $key) : ?>
                                    <?php if ($job->post_status == 'publish') : ?>
                                        <a href="<?php echo esc_url(get_permalink($job->ID)); ?>"><?php wpjm_the_job_title($job); ?></a>
                                    <?php else : ?>
                                        <!-- Le titre -->
                                        <?php wpjm_the_job_title($job); ?> <small>(<?php the_job_status($job); ?>)</small>
                                    <?php endif; ?>
                                    <?php echo is_position_featured($job) ? '<span class="featured-job-icon" title="' . esc_attr__('Featured Job', 'wp-job-manager') . '"></span>' : ''; ?>
                                    <ul class="job-dashboard-actions">
                                        <?php
                                        if (!empty($job_actions[$job->ID])) {
                                            foreach ($job_actions[$job->ID] as $action => $value) {
                                                $action_url = add_query_arg([
                                                    'action' => $action,
                                                    'job_id' => $job->ID
                                                ]);
                                                if ($value['nonce']) {
                                                    $action_url = wp_nonce_url($action_url, $value['nonce']);
                                                }
                                                echo '<li><a href="' . esc_url($action_url) . '" class="job-dashboard-action-' . esc_attr($action) . '">' . esc_html($value['label']) . '</a></li>';
                                            }
                                        }
                                        ?>
                                    </ul>
                                    <!-- La date -->
                                <?php elseif ('date' === $key) : ?>
                                    <?php echo esc_html(wp_date(get_option('date_format'), get_post_datetime($job)->getTimestamp())); ?>
                                    <!-- Expiration -->
                                <?php elseif ('expires' === $key) : ?>
                                    <?php
                                    $job_expires = WP_Job_Manager_Post_Types::instance()->get_job_expiration($job);
                                    echo esc_html($job_expires ? wp_date(get_option('date_format'), $job_expires->getTimestamp()) : '&ndash;');
                                    ?>
                                <?php elseif ('filled' === $key) : ?>
                                    <?php echo is_position_filled($job) ? '&#10004;' : '&ndash;';
                                    ?>
                                <?php elseif ('candidat' === $key) : ?>
                                    <?= get_the_job_application_method($post = $job->ID)->email;
                                    ?>
                                <?php elseif ('company' === $key) : ?>
                                    <?php the_company_name($before = '', $after = '', $echo = true, $post = $job->ID);
                                    ?>
                                <?php else : ?>
                                    <?php do_action('job_manager_job_dashboard_column_' . $key, $job); ?>
                                <?php endif; ?>
                            </td>
                        <?php endforeach; ?>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
        <?php if ($submit_job_form_page_id && (job_manager_count_user_job_listings() < $submission_limit || !$submission_limit)) : ?>
            <tfoot>
                <tr>
                    <td colspan="<?php echo count($job_dashboard_columns); ?>">
                        <a href="<?php echo esc_url(get_permalink($submit_job_form_page_id)); ?>"><?php esc_html_e('Add Job', 'wp-job-manager'); ?></a>
                    </td>
                </tr>
            </tfoot>
        <?php endif; ?>
    </table>
    <?php get_job_manager_template('pagination.php', ['max_num_pages' => $max_num_pages]); ?>
</div>