<?php get_header(); ?>
<?php $app_db = AppDb::getInstance(); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <div class="container">
        <div class="row mb-5 mb-lg-6 pt-6">
            <div class="col-12 col-lg-5 offset-lg-1">
                <h1 class="mb-3 mb-lg-4 display-1 font-weight-bold mr-7 mr-lg-0"><?php the_title(); ?></h1>
                <div class="d-lg-none mb-4">
                    <a href="<?php echo cryptotask_get_option('app_url'); ?>/create-task"
                       class="btn btn-round btn-info mr-3">Post Job</a>
                    <a href="<?php echo cryptotask_get_option('app_url'); ?>/tasks"
                       class="btn btn-round btn-outline-dark">Browse Jobs</a>
                </div>
                <div class="mb-4 lead">
                    <?php the_content(); ?>
                </div>
                <div class="d-none d-lg-block">
                    <a href="<?php echo cryptotask_get_option('app_url'); ?>/create-task"
                       class="btn btn-round btn-info mr-3">Post Job</a>
                    <a href="<?php echo cryptotask_get_option('app_url'); ?>/tasks"
                       class="btn btn-round btn-outline-dark">Browse Jobs</a>
                </div>
            </div>
        </div>

        <div class="row mb-5 mb-lg-7">
            <div class="col-12 col-lg-7 offset-lg-1">
                <div class="d-flex align-items-end mb-4 justify-content-between justify-content-lg-start">
                    <h3 class="mb-0 mr-3">Featured Freelancers</h3>
                    <a href="<?php echo cryptotask_get_option('app_url'); ?>/freelancers">
                        <u>Browse <span class="d-none d-lg-inline">Freelancers</span></u>
                    </a>
                </div>
                <?php $freelancersData = $app_db->get_featured_freelancers(); ?>
                <?php $i = 0; ?>
                <!-- Nav tabs -->
                <ul class="nav nav-tabs mb-3" role="tablist" id="freelancers">
                    <?php foreach ($freelancersData as $cat => $freelancers) : ?>
                        <li class="nav-item">
                            <a class="d-inline nav-link <?php echo $i === 0 ? 'active' : ''; ?>" data-toggle="tab"
                               href="#tab-<?php echo $i; ?>" role="tab"
                               aria-controls="<?php echo md5($cat); ?>" aria-selected="true"><?php echo $cat; ?></a>
                            <span> / </span>
                        </li>
                        <?php $i++; ?>
                    <?php endforeach; ?>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content" id="freelancersContent">
                    <?php $i = 0; ?>
                    <?php foreach ($freelancersData as $cat => $freelancers) : ?>
                        <div class="tab-pane fade <?php echo $i === 0 ? 'show active' : ''; ?>"
                             id="tab-<?php echo $i; ?>"
                             role="tabpanel">
                            <div class="row">
                                <div class="col-12 col-lg-11">
                                    <ul class="list-unstyled row">
                                        <?php foreach ($freelancers as $freelancer) : ?>
                                            <li class="col-6 col-xl-4">
                                                <div class="pb-5">
                                                    <a href="<?php echo cryptotask_get_option('app_url'); ?>/freelancers/<?php echo $freelancer['id']; ?>"
                                                       class="freelancer d-block">
                                                        <img class="avatar d-block mb-3"
                                                             src="<?php echo $freelancer['picture']; ?>"
                                                             alt="<?php echo $freelancer['name']; ?>"/>
                                                        <strong><?php echo $freelancer['name']; ?></strong>
                                                        <div><?php echo $freelancer['occupation']; ?></div>
                                                    </a>
                                                </div>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <?php $i++; ?>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php $projects = $app_db->get_featured_projects(); ?>
            <div class="col-12 col-lg-3">
                <div class="d-flex flex-column flex-lg-row align-items-lg-end mb-4">
                    <h3 class="mb-0 mr-3">Featured Projects</h3>
                    <?php if (count($projects)) : ?>
                        <span>
                            Latest post <?php echo latest_post_from_date($projects[0]); ?> ago
                        </span>
                    <?php endif; ?>
                </div>

                <ul class="featured-projects list-unstyled">
                    <?php foreach ($projects as $project) : ?>
                        <li class="mb-4 mb-lg-5">
                            <?php echo $project->client_name; ?>
                            <h3 class="my-2">
                                <a href="<?php echo cryptotask_get_option('app_url'); ?>/tasks/<?php echo $project->id; ?>">
                                    <?php echo $project->title; ?>
                                </a>
                            </h3>
                            <div class="d-flex align-items-center">
                                <div class="mr-4"><?php echo ct_task_type_mapping($project->type); ?>
                                    /<?php echo ct_task_location_mapping($project->location); ?></div>
                                <div><?php echo date('M j', strtotime($project->createdAt)); ?></div>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-lg-3 offset-lg-1">
                <h4 class="mb-4">Our Mission</h4>
                <p class="lead">
                    We are dedicated to help freelancers and companies rethink how to do business.
                    We offer SmartContract powered solution for reducing fees and legal overhead.
                </p>
            </div>
        </div>
    </div>
<?php endwhile; endif; ?>

<?php get_footer();
