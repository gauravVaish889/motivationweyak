<?php
/**
 * Quiz context
 *
 * @package Tutor\Views
 * @subpackage Tutor\Quiz
 * @author Themeum <support@themeum.com>
 * @link https://themeum.com
 * @since 1.0.0
 */

$contexts = array(
	'attempt-table'           => array(
		'columns'  => array(
			'checkbox'         => '<div class="tutor-d-flex"><input type="checkbox" id="tutor-bulk-checkbox-all" class="tutor-form-check-input" /></div>',
			'date'             => __( 'Date', 'edcare' ),
			'quiz_info'        => __( 'Quiz Info', 'edcare' ),
			'course'           => __( 'Course', 'edcare' ),
			'question'         => __( 'Question', 'edcare' ),
			'total_marks'      => __( 'Total Marks', 'edcare' ),
			'correct_answer'   => __( 'Correct Answer', 'edcare' ),
			'incorrect_answer' => __( 'Incorrect Answer', 'edcare' ),
			'earned_marks'     => __( 'Earned Marks', 'edcare' ),
			'result'           => __( 'Result', 'edcare' ),
			'details'          => __( 'Details', 'edcare' ),
		),
		'contexts' => array(
			'frontend-dashboard-my-attempts'       => array(
				'quiz_info',
				'question',
				'total_marks',
				'correct_answer',
				'incorrect_answer',
				'earned_marks',
				'result',
				'details',
			),
			'frontend-dashboard-students-attempts' => 'frontend-dashboard-my-attempts',
			'course-single-previous-attempts'      => array(
				'date',
				'question',
				'total_marks',
				'correct_answer',
				'incorrect_answer',
				'earned_marks',
				'result',
				'details',
			),
			'backend-dashboard-students-attempts'  => array(
				'checkbox',
				'quiz_info',
				'course',
				'question',
				'total_marks',
				'correct_answer',
				'incorrect_answer',
				'earned_marks',
				'result',
				'details',
			),
		),
	),
	'attempt-details-summary' => array(
		'columns'  => array(
			'user'             => __( 'Attempt By', 'edcare' ),
			'date'             => __( 'Date', 'edcare' ),
			'qeustion_count'   => __( 'Question', 'edcare' ),
			'quiz_time'        => __( 'Quiz Time', 'edcare' ),
			'attempt_time'     => __( 'Attempt Time', 'edcare' ),
			'total_marks'      => __( 'Total Marks', 'edcare' ),
			'pass_marks'       => __( 'Pass Marks', 'edcare' ),
			'correct_answer'   => __( 'Correct Answer', 'edcare' ),
			'incorrect_answer' => __( 'Incorrect Answer', 'edcare' ),
			'earned_marks'     => __( 'Earned Marks', 'edcare' ),
			'result'           => __( 'Result', 'edcare' ),
		),
		'contexts' => array(
			'frontend-dashboard-my-attempts'       => array(
				'date',
				'qeustion_count',
				'total_marks',
				'pass_marks',
				'correct_answer',
				'incorrect_answer',
				'earned_marks',
				'result',
			),
			'frontend-dashboard-students-attempts' => 'frontend-dashboard-my-attempts',
			'course-single-previous-attempts'      => 'frontend-dashboard-my-attempts',
			'backend-dashboard-students-attempts'  => true,
		),
	),
	'attempt-details-answers' => array(
		'columns'  => array(
			'no'             => __( 'No', 'edcare' ),
			'type'           => __( 'Type', 'edcare' ),
			'questions'      => __( 'Questions', 'edcare' ),
			'given_answer'   => __( 'Given Answer', 'edcare' ),
			'correct_answer' => __( 'Correct Answer', 'edcare' ),
			'result'         => __( 'Result', 'edcare' ),
			'manual_review'  => __( 'Review', 'edcare' ),
		),
		'contexts' => array(
			'frontend-dashboard-my-attempts'       => array(
				'no',
				'type',
				'questions',
				'given_answer',
				'correct_answer',
				'result',
			),
			'frontend-dashboard-students-attempts' => array(
				'no',
				'type',
				'questions',
				'given_answer',
				'correct_answer',
				'result',
				'manual_review',
			),
			'backend-dashboard-students-attempts'  => 'frontend-dashboard-students-attempts',
			'course-single-previous-attempts'      => 'frontend-dashboard-my-attempts',
		),
	),
);

return tutor_utils()->get_table_columns_from_context( $page_key, $context, $contexts, 'tutor/quiz/attempts/table/column' );
