<?php
/**
 * Created by PhpStorm.
 * User: Toni
 * Date: 03.08.2016
 * Time: 18:48
 */

/**@var \app\models\Document[] $documents */

const MAXSTATUS = 80;

foreach ($documents as $document): ?>
    <div class="col-md-12">
        <div class="col-md-2">
            <?php if ($document->status < 50): ?>
                <i class="fa fa-file-text-o fa-3x" aria-hidden="true"></i>
                <i class="fa fa-cog fa-spin fa-3x fa-fw"></i>
                <span class="sr-only">Loading...</span>
            <?php else: ?>
                <img src="./data/<?= $document->folder ?>/thumb.jpeg" height="100">
            <?php endif; ?>
        </div>
        <div class="col-md-3">
            <h2 style="margin-top: 0px; line-height: 1;"><?= $document->input_filename.'.'.$document->input_file_extension ?></h2>
        </div>

        <div class="col-md-7">
            <div class="progress">
                <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="100"
                     aria-valuemin="0" aria-valuemax="100" style="width: <?= ($document->status/MAXSTATUS*100) ?>%;">
                    <span class="" style="color: #000000; white-space: nowrap;text-shadow: 1px 1px 0px #ffffff;"><?= Yii::t('app/analyse-status',$document->status) ?></span>
                </div>
            </div>
        </div>
    </div>

<?php endforeach; ?>
