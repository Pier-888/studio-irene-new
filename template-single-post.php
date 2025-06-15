<?php
// File per la visualizzazione del singolo post del blog
// Incluso da template-blog.php quando si visualizza un singolo articolo

$featured_image = get_the_post_thumbnail_url($single_post->ID) ?: 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?w=1200&h=600&fit=crop&auto=format';
$categories = get_the_category($single_post->ID);
$category_name = !empty($categories) ? $categories[0]->name : 'Generale';
$reading_time = ceil(str_word_count(get_post_field('post_content', $single_post->ID)) / 200);
?>

<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <button onclick="window.location.href='<?php echo get_permalink(); ?>'" class="mb-6 flex items-center space-x-2 px-4 py-2 rounded-2xl text-emerald-600 hover:bg-emerald-50 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            <span>Torna al blog</span>
        </button>

        <article class="bg-white rounded-3xl shadow-sm overflow-hidden border border-emerald-100">
            <div class="relative">
                <img src="<?php echo $featured_image; ?>" 
                     alt="<?php echo get_the_title($single_post->ID); ?>"
                     class="w-full h-64 md:h-96 object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/20 to-transparent flex items-end">
                    <div class="p-8 text-white">
                        <span class="bg-emerald-500 hover:bg-emerald-600 text-white mb-4 rounded-full px-3 py-1 text-sm inline-block">
                            <?php echo $category_name; ?>
                        </span>
                        <h1 class="text-3xl md:text-5xl font-bold mb-4 leading-tight">
                            <?php echo get_the_title($single_post->ID); ?>
                        </h1>
                        <p class="text-xl text-emerald-100 leading-relaxed">
                            <?php echo get_the_excerpt($single_post->ID); ?>
                        </p>
                    </div>
                </div>
            </div>

            <div class="p-8">
                <div class="flex flex-wrap items-center justify-between mb-8 pb-6 border-b border-emerald-100">
                    <div class="flex items-center space-x-6">
                        <div class="flex items-center space-x-3">
                            <img src="<?php echo get_avatar_url(get_post_field('post_author', $single_post->ID), array('size' => 48)); ?>" 
                                 alt="<?php echo get_the_author_meta('display_name', get_post_field('post_author', $single_post->ID)); ?>"
                                 class="w-12 h-12 rounded-full">
                            <div>
                                <p class="font-semibold text-slate-800"><?php echo get_the_author_meta('display_name', get_post_field('post_author', $single_post->ID)); ?></p>
                                <p class="text-sm text-slate-500">Psicologa</p>
                            </div>
                        </div>
                        
                        <div class="flex items-center space-x-4 text-sm text-slate-500">
                            <div class="flex items-center space-x-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <span><?php echo get_the_date('d/m/Y', $single_post->ID); ?></span>
                            </div>
                            
                            <div class="flex items-center space-x-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <span><?php echo $reading_time; ?> min di lettura</span>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center space-x-2">
                        <button class="flex items-center space-x-2 px-4 py-2 rounded-2xl border border-emerald-200 hover:bg-emerald-50 text-sm text-slate-600">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                            </svg>
                            <span>Mi piace</span>
                        </button>
                        <button class="flex items-center space-x-2 px-4 py-2 rounded-2xl border border-emerald-200 hover:bg-emerald-50 text-sm text-slate-600">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.367 2.684 3 3 0 00-5.367-2.684z"/>
                            </svg>
                            <span>Condividi</span>
                        </button>
                    </div>
                </div>

                <div class="prose prose-lg max-w-none text-slate-700 leading-relaxed">
                    <?php echo apply_filters('the_content', get_post_field('post_content', $single_post->ID)); ?>
                </div>

                <?php $tags = get_the_tags($single_post->ID); ?>
                <?php if ($tags): ?>
                <div class="mt-8 pt-6 border-t border-emerald-100">
                    <h3 class="text-lg font-semibold mb-4 text-slate-800">Argomenti:</h3>
                    <div class="flex flex-wrap gap-2">
                        <?php foreach($tags as $tag): ?>
                        <span class="cursor-pointer hover:bg-emerald-100 rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200 px-3 py-1 text-sm">
                            <?php echo $tag->name; ?>
                        </span>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </article>

        <div class="mt-8 bg-white rounded-3xl shadow-sm p-8 border border-emerald-100">
            <h3 class="text-2xl font-bold mb-6 text-slate-800">Hai bisogno di aiuto?</h3>
            <div class="bg-gradient-to-br from-emerald-50 to-teal-50 p-6 rounded-2xl">
                <p class="text-slate-700 mb-4 leading-relaxed">
                    Se questo articolo ha risuonato con te o se stai attraversando un momento difficile, 
                    ricorda che non sei solo. Come psicologa, sono qui per offrirti il supporto di cui hai bisogno.
                </p>
                <div class="flex flex-col sm:flex-row gap-3">
                    <button onclick="window.location.href='/contatti'" class="bg-emerald-500 text-white px-6 py-3 rounded-2xl hover:bg-emerald-600 transition-colors font-medium">
                        Prenota una Consulenza
                    </button>
                    <button onclick="window.location.href='/chi-sono'" class="border border-emerald-300 text-emerald-600 px-6 py-3 rounded-2xl hover:bg-emerald-50 transition-colors">
                        Scopri di più
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
