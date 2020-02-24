
<?php

//progress and completed
select 
qu.in_waiting_queue as que,qu.id as quid,
sint.interview_start as startint,sint.interview_end as endint,
sint.id as interviewid,concat(spop.fname," ",spop.lname) as popname,
spop.id as popid,susers.uname,susers.id as uid,sspop.completed,sspop.locked,
type.type,sgroup.sample_name as groupname,sgroup.id as groupid,
study.name as studyname,study.id as studyid
from survey_interview sint
join study_to_survey_pop sspop on sint.study_to_survey_pop_id = sspop.id
join survey_queue qu on qu.study_to_survey_pop_id = sint.study_to_survey_pop_id
join study on sspop.study_id = study.id
join sample_group sgroup on sspop.sample_group_id = sgroup.id 
join survey_population spop on sspop.survey_population_id = spop.id 
join survey_users susers on sint.survey_users_id = susers.id 
join type on sint.type_id = type.id
where type.type = 'Completed';


//all interviews in ques
select 
qu.in_waiting_queue as que,qu.id as quid,
concat(spop.fname," ",spop.lname) as popname,spop.id as popid,sspop.locked,
sspop.completed,sgroup.sample_name as groupname,sgroup.id as groupid,
study.name as studyname,study.id as studyid
from survey_queue qu
join study_to_survey_pop sspop on qu.study_to_survey_pop_id = sspop.id
join study on sspop.study_id = study.id
join sample_group sgroup on sspop.sample_group_id = sgroup.id 
join survey_population spop on sspop.survey_population_id = spop.id
where sspop.completed=0 and sspop.locked=0; 

?>

