<?php $__env->startSection('title', 'Training Mode'); ?>

<?php $__env->startSection('content'); ?>
<div class="text-center">
    <h1>Training mode</h1>
    <p class="subtitle">Study the capitals to improve your chance at passing the quiz</p>

    <div style="margin: 20px 0;">
        <a href="<?php echo e(route('home')); ?>" class="btn"> Back to Home</a>
    </div>

    <div style="margin: 30px 0;">
        <input type="text"
               id="searchBox"
               placeholder="Search countries..."
               onkeyup="filterCountries()"
               style="max-width: 400px; margin: 0 auto;">
    </div>
</div>

<div class="countries-grid">
    <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="country-card" data-name="<?php echo e(strtolower($country->name)); ?>" data-capital="<?php echo e(strtolower($country->capital)); ?>" data-region="<?php echo e(strtolower($country->region)); ?>">
            <div class="country-header">
                <img src="<?php echo e($country->flag_url); ?>"
                     alt="Flag of <?php echo e($country->name); ?>"
                     class="country-flag"
                     onerror="this.src='data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNDAiIHZpZXdCb3g9IjAgMCA2MCA0MCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHJlY3Qgd2lkdGg9IjYwIiBoZWlnaHQ9IjQwIiBmaWxsPSIjY2NjIi8+Cjx0ZXh0IHg9IjMwIiB5PSIyMiIgdGV4dC1hbmNob3I9Im1pZGRsZSIgZm9udC1zaXplPSIxMiIgZmlsbD0iIzY2NiI+Tm8gRmxhZzwvdGV4dD4KPHN2Zz4K'; this.onerror=null;">
                <div class="country-name"><?php echo e($country->name); ?></div>
            </div>

            <div class="country-info">
                <div class="info-row">
                    <span class="info-label">Capital:</span>
                    <span class="info-value"><?php echo e($country->capital); ?></span>
                </div>
                <div class="info-row">
                    <span class="info-label"> Region:</span>
                    <span class="info-value"><?php echo e($country->region); ?></span>
                </div>
                <div class="info-row">
                    <span class="info-label"> Code:</span>
                    <span class="info-value"><?php echo e($country->code); ?></span>
                </div>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>

<div id="noResults" class="no-results" style="display: none;">
    <h3> No countries found</h3>
    <p>Try searching with different words</p>
</div>

<?php $__env->startPush('styles'); ?>
<style>
    .countries-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 20px;
        margin-top: 20px;
    }

    .country-card {
        background: rgba(255,255,255,0.1);
        border-radius: 12px;
        padding: 20px;
        transition: all 0.3s ease;
        border: 1px solid rgba(255,255,255,0.1);
    }

    .country-card:hover {
        transform: translateY(-5px);
        background: rgba(255,255,255,0.15);
        box-shadow: 0 8px 25px rgba(0,0,0,0.2);
    }

    .country-header {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-bottom: 20px;
        padding-bottom: 15px;
        border-bottom: 1px solid rgba(255,255,255,0.2);
    }

    .country-flag {
        width: 60px;
        height: 40px;
        object-fit: cover;
        border-radius: 4px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.3);
        border: 1px solid rgba(255,255,255,0.2);
    }

    .country-name {
        font-size: 1.3em;
        font-weight: bold;
        color: #4CAF50;
        flex: 1;
    }

    .country-info {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .info-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 8px 0;
    }

    .info-label {
        font-weight: 500;
        opacity: 0.9;
        min-width: 80px;
    }

    .info-value {
        font-weight: bold;
        text-align: right;
        color: #fff;
    }

    .no-results {
        text-align: center;
        padding: 40px;
        color: rgba(255,255,255,0.7);
    }

    @media (max-width: 768px) {
        .countries-grid {
            grid-template-columns: 1fr;
        }

        .country-header {
            flex-direction: column;
            text-align: center;
            gap: 10px;
        }

        .info-row {
            flex-direction: column;
            text-align: center;
            gap: 5px;
        }

        .info-value {
            text-align: center;
        }
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    function filterCountries() {
        const searchTerm = document.getElementById('searchBox').value.toLowerCase().trim();
        const countryCards = document.querySelectorAll('.country-card');
        const noResults = document.getElementById('noResults');
        let visibleCount = 0;

        countryCards.forEach(card => {
            const countryName = card.getAttribute('data-name');
            const capital = card.getAttribute('data-capital');
            const region = card.getAttribute('data-region');

            const matches = countryName.includes(searchTerm) ||
                           capital.includes(searchTerm) ||
                           region.includes(searchTerm);

            if (matches || searchTerm === '') {
                card.style.display = 'block';
                visibleCount++;
            } else {
                card.style.display = 'none';
            }
        });


        if (visibleCount === 0 && searchTerm !== '') {
            noResults.style.display = 'block';
        } else {
            noResults.style.display = 'none';
        }
    }
    document.addEventListener('keydown', function(e) {
        if (e.key === '/' && e.target.tagName !== 'INPUT') {
            e.preventDefault();
            document.getElementById('searchBox').focus();
        }

        if (e.key === 'Escape') {
            document.getElementById('searchBox').value = '';
            filterCountries();
            document.getElementById('searchBox').blur();
        }
    });
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('searchBox').focus();
    });
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/wendyas/boh php/pro_ggg/resources/views/training.blade.php ENDPATH**/ ?>