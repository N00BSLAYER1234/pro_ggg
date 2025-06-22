<!-- resources/views/results.blade.php -->


<?php $__env->startSection('title', 'Quiz Results'); ?>

<?php $__env->startSection('content'); ?>
<div class="text-center">
    <h1>🎉 Quiz Complete!</h1>

    <div class="score-display" style="margin: 30px 0;">
        <div class="score-circle">
            <?php echo e($percentage); ?>%
        </div>
        <p style="font-size: 1.3em; margin-top: 20px;">
            <?php echo e($score); ?> out of <?php echo e($total); ?> correct answers
        </p>
    </div>

    <div class="performance-feedback" style="margin: 30px 0;">
        <?php if($percentage >= 90): ?>
            <div class="feedback excellent">
                 <strong>Excellent!</strong>
            </div>
        <?php elseif($percentage >= 70): ?>
            <div class="feedback good">
                 <strong>Very goose!</strong>
            </div>
        <?php elseif($percentage >= 50): ?>
            <div class="feedback average">
                 <strong>Not bad!</strong>
            </div>
        <?php else: ?>
            <div class="feedback poor">
                 <strong>Keep learning!</strong>
            </div>
        <?php endif; ?>
    </div>

    <div class="stats-grid">
        <div class="stat-item">
            <div class="stat-number"><?php echo e($score); ?></div>
            <div class="stat-label">Correct</div>
        </div>
        <div class="stat-item">
            <div class="stat-number"><?php echo e($total - $score); ?></div>
            <div class="stat-label">Wrong</div>
        </div>
        <div class="stat-item">
            <div class="stat-number"><?php echo e(ucfirst($difficulty)); ?></div>
            <div class="stat-label">Level</div>
        </div>
        <?php if($timeElapsed): ?>
        <div class="stat-item">
            <div class="stat-number"><?php echo e(gmdate('i:s', $timeElapsed)); ?></div>
            <div class="stat-label">Time</div>
        </div>
        <?php endif; ?>
    </div>

    <div style="margin-top: 40px;">
        <a href="<?php echo e(route('home')); ?>" class="btn">
             Play Again
        </a>
        <a href="<?php echo e(route('training')); ?>" class="btn btn-secondary">
             Study Mode
        </a>
    </div>
</div>

<?php $__env->startPush('styles'); ?>
<style>
    .score-circle {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        background: conic-gradient(
            #4CAF50 0deg,
            #4CAF50 <?php echo e($percentage * 3.6); ?>deg,
            rgba(255,255,255,0.2) <?php echo e($percentage * 3.6); ?>deg
        );
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.5em;
        font-weight: bold;
        margin: 0 auto;
        color: white;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
        gap: 20px;
        margin: 30px 0;
    }

    .stat-item {
        background: rgba(255,255,255,0.1);
        padding: 20px;
        border-radius: 10px;
        text-align: center;
    }

    .stat-number {
        font-size: 2em;
        font-weight: bold;
        color: #4CAF50;
        margin-bottom: 5px;
    }

    .stat-label {
        font-size: 0.9em;
        opacity: 0.8;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .feedback {
        padding: 20px;
        border-radius: 10px;
        font-size: 1.2em;
        margin: 20px 0;
    }

    .feedback.excellent {
        background: rgba(76, 175, 80, 0.2);
        border: 2px solid #4CAF50;
    }

    .feedback.good {
        background: rgba(255, 193, 7, 0.2);
        border: 2px solid #FFC107;
    }

    .feedback.average {
        background: rgba(33, 150, 243, 0.2);
        border: 2px solid #2196F3;
    }

    .feedback.poor {
        background: rgba(244, 67, 54, 0.2);
        border: 2px solid #f44336;
    }
</style>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/wendyas/boh php/pro_ggg/resources/views/results.blade.php ENDPATH**/ ?>