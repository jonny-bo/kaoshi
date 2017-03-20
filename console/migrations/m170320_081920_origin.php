<?php

use yii\db\Migration;

class m170320_081920_origin extends Migration
{
    public function up()
    {
        $sql = "
            CREATE TABLE IF NOT EXISTS `question` (
              `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '题目ID',
              `type` varchar(64) NOT NULL DEFAULT '' COMMENT '题目类型',
              `stem` text COMMENT '题干',
              `score` float(10,1) unsigned NOT NULL DEFAULT '0.0' COMMENT '分数',
              `answer` text COMMENT '参考答案',
              `analysis` text COMMENT '解析',
              `metas` text COMMENT '题目元信息',
              `categoryId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '类别',
              `difficulty` varchar(64) NOT NULL DEFAULT 'normal' COMMENT '难度',
              `target` varchar(255) NOT NULL DEFAULT '' COMMENT '从属于',
              `parentId` int(10) unsigned DEFAULT '0' COMMENT '材料父ID',
              `subCount` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '子题数量',
              `finishedTimes` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '完成次数',
              `passedTimes` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '成功次数',
              `userId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户id',
              `updatedTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
              `createdTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
              `copyId` int(10) NOT NULL DEFAULT '0' COMMENT '复制问题对应Id',
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='问题表' AUTO_INCREMENT=3 ;
            CREATE TABLE IF NOT EXISTS `question_category` (
              `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '题目类别ID',
              `name` varchar(255) NOT NULL COMMENT '类别名称',
              `target` varchar(255) NOT NULL DEFAULT '' COMMENT '从属于',
              `userId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '操作用户',
              `updatedTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
              `createdTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
              `seq` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '排序序号',
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='题库类别表' AUTO_INCREMENT=1 ;
            CREATE TABLE IF NOT EXISTS `question_marker` (
              `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
              `markerId` int(10) unsigned NOT NULL COMMENT '驻点Id',
              `questionId` int(10) unsigned NOT NULL COMMENT '问题Id',
              `seq` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
              `type` varchar(64) NOT NULL DEFAULT '' COMMENT '题目类型',
              `stem` text COMMENT '题干',
              `answer` text COMMENT '参考答案',
              `analysis` text COMMENT '解析',
              `metas` text COMMENT '题目元信息',
              `difficulty` varchar(64) NOT NULL DEFAULT 'normal' COMMENT '难度',
              `createdTime` int(10) unsigned NOT NULL DEFAULT '0',
              `updatedTime` int(10) unsigned NOT NULL DEFAULT '0',
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='弹题' AUTO_INCREMENT=1 ;
            CREATE TABLE IF NOT EXISTS `question_marker_result` (
              `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
              `markerId` int(10) unsigned NOT NULL COMMENT '驻点Id',
              `questionMarkerId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '弹题ID',
              `lessonId` int(10) unsigned NOT NULL DEFAULT '0',
              `userId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '做题人ID',
              `status` enum('none','right','partRight','wrong','noAnswer') NOT NULL DEFAULT 'none' COMMENT '结果状态',
              `answer` text,
              `createdTime` int(10) unsigned NOT NULL DEFAULT '0',
              `updatedTime` int(10) unsigned NOT NULL DEFAULT '0',
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
            CREATE TABLE IF NOT EXISTS `testpaper` (
              `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '试卷ID',
              `name` varchar(255) NOT NULL DEFAULT '' COMMENT '试卷名称',
              `description` text COMMENT '试卷说明',
              `limitedTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '限时(单位：秒)',
              `pattern` varchar(255) NOT NULL DEFAULT '' COMMENT '试卷生成/显示模式',
              `target` varchar(255) NOT NULL DEFAULT '' COMMENT '试卷所属对象',
              `status` varchar(32) NOT NULL DEFAULT 'draft' COMMENT '试卷状态：draft,open,closed',
              `score` float(10,1) unsigned NOT NULL DEFAULT '0.0' COMMENT '总分',
              `passedScore` float(10,1) unsigned NOT NULL DEFAULT '0.0' COMMENT '通过考试的分数线',
              `itemCount` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '题目数量',
              `createdUserId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建人',
              `createdTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
              `updatedUserId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '修改人',
              `updatedTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '修改时间',
              `metas` text COMMENT '题型排序',
              `copyId` int(10) NOT NULL DEFAULT '0' COMMENT '复制试卷对应Id',
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
            CREATE TABLE IF NOT EXISTS `testpaper_item` (
              `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '试卷条目ID',
              `testId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '所属试卷',
              `seq` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '题目顺序',
              `questionId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '题目ID',
              `questionType` varchar(64) NOT NULL DEFAULT '' COMMENT '题目类别',
              `parentId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '父题ID',
              `score` float(10,1) unsigned NOT NULL DEFAULT '0.0' COMMENT '分值',
              `missScore` float(10,1) unsigned NOT NULL DEFAULT '0.0' COMMENT '漏选得分',
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
            CREATE TABLE IF NOT EXISTS `testpaper_item_result` (
              `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '试卷题目做题结果ID',
              `itemId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '试卷条目ID',
              `testId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '试卷ID',
              `testPaperResultId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '试卷结果ID',
              `userId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '做题人ID',
              `questionId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '题目ID',
              `status` enum('none','right','partRight','wrong','noAnswer') NOT NULL DEFAULT 'none' COMMENT '结果状态',
              `score` float(10,1) NOT NULL DEFAULT '0.0' COMMENT '得分',
              `answer` text COMMENT '回答',
              `teacherSay` text COMMENT '老师评价',
              `pId` int(10) NOT NULL DEFAULT '0' COMMENT '复制试卷题目Id',
              PRIMARY KEY (`id`),
              KEY `testPaperResultId` (`testPaperResultId`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
            CREATE TABLE IF NOT EXISTS `testpaper_result` (
              `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '试卷结果ID',
              `paperName` varchar(255) NOT NULL DEFAULT '' COMMENT '试卷名称',
              `testId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '试卷ID',
              `userId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '做卷人ID',
              `score` float(10,1) unsigned NOT NULL DEFAULT '0.0' COMMENT '总分',
              `objectiveScore` float(10,1) unsigned NOT NULL DEFAULT '0.0' COMMENT '主观题得分',
              `subjectiveScore` float(10,1) unsigned NOT NULL DEFAULT '0.0' COMMENT '客观题得分',
              `teacherSay` text COMMENT '老师评价',
              `rightItemCount` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '正确题目数',
              `passedStatus` enum('none','excellent','good','passed','unpassed') NOT NULL DEFAULT 'none' COMMENT '考试通过状态，none表示该考试没有',
              `limitedTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '试卷限制时间(秒)',
              `beginTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '开始时间',
              `endTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '结束时间',
              `updateTime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '最后更新时间',
              `active` tinyint(3) unsigned NOT NULL DEFAULT '0',
              `status` enum('doing','paused','reviewing','finished') NOT NULL COMMENT '状态',
              `target` varchar(255) NOT NULL DEFAULT '' COMMENT '试卷结果所属对象',
              `checkTeacherId` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '批卷老师ID',
              `checkedTime` int(11) NOT NULL DEFAULT '0' COMMENT '批卷时间',
              `usedTime` int(10) unsigned NOT NULL DEFAULT '0',
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
            ";

            $this->execute($sql);
    }

    public function down()
    {
        $this->execute("
            DROP TABLE IF EXISTS `question`;
            DROP TABLE IF EXISTS `question_category`;
            DROP TABLE IF EXISTS `question_marker`;
            DROP TABLE IF EXISTS `question_marker_result`;
            DROP TABLE IF EXISTS `testpaper`;
            DROP TABLE IF EXISTS `testpaper_item`;
            DROP TABLE IF EXISTS `testpaper_item_result`;
            DROP TABLE IF EXISTS `testpaper_result`;
        ");
    }
}
