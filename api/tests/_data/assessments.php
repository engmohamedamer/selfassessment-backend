<?php
return [
    // open assessment
    [
        'survey_id'=>1,
        'org_id'=>5,
        'survey_name' => 'Assessment one',
        'survey_created_at'=>'2019-12-01 13:50:00',
        'survey_expired_at'=>'2019-12-26 13:50:00',
        'survey_is_pinned'=>0,
        'survey_is_closed'=>0,
        'survey_time_to_pass'=>10,
        'survey_is_private'=>0,
        'survey_is_visible'=>1,
        'start_info'=>'Start Info',
        'survey_point'=>10,
    ],
    // closed assessment 403 - Forbidden
    [
        'survey_id'=>2,
        'org_id'=>5,
        'survey_name' => 'Assessment one',
        'survey_created_at'=>'2019-12-01 13:50:00',
        'survey_expired_at'=>'2019-12-26 13:50:00',
        'survey_is_pinned'=>0,
        'survey_is_closed'=>1,
        'survey_time_to_pass'=>10,
        'survey_is_private'=>0,
        'survey_is_visible'=>1,
        'start_info'=>'Start Info',
        'survey_point'=>10,
    ],
    // open but assessment expire at not available 403 - Forbidden
    [
        'survey_id'=>3,
        'org_id'=>5,
        'survey_name' => 'Assessment one',
        'survey_created_at'=>'2019-11-01 13:50:00',
        'survey_expired_at'=>'2019-12-01 13:50:00',
        'survey_is_pinned'=>0,
        'survey_is_closed'=>0,
        'survey_time_to_pass'=>10,
        'survey_is_private'=>0,
        'survey_is_visible'=>1,
        'start_info'=>'Start Info',
        'survey_point'=>10,
    ],
];
