<?php
/*
Template Name: Blog Psicologia
*/

get_header(); ?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog - Dott.ssa Irene Orlandelli Psicologa a Milano</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        emerald: {
                            50: '#ecfdf5',
                            100: '#d1fae5',
                            200: '#a7f3d0',
                            300: '#6ee7b7',
                            400: '#34d399',
                            500: '#10b981',
                            600: '#059669',
                            700: '#047857',
                            800: '#065f46',
                            900: '#064e3b'
                        }
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gradient-to-br from-emerald-50/30 via-white to-teal-50/30">

<!-- Header del Blog -->
<div class="bg-gradient-to-br from-emerald-50 via-teal-50 to-blue-50 py-20">
    <div class="container mx-auto px-4">
        <div class="text-center max-w-4xl mx-auto">
            <h1 class="text-5xl md:text-6xl font-bold mb-6 bg-gradient-to-r from-emerald-700 to-teal-600 bg-clip-text text-transparent">
                Il Mio Blog
            </h1>
            <p class="text-xl md:text-2xl text-slate-600 mb-8 leading-relaxed">
                Riflessioni, consigli e approfondimenti per il benessere mentale
            </p>
            <div class="max-w-md mx-auto relative">
                <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 text-slate-400 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m21 21-6-6m2-5a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z"/>
                </svg>
                <input
                    type="text"
                    placeholder="Cerca articoli..."
                    class="pl-10 py-3 text-lg bg-white/80 border border-emerald-200 text-slate-700 placeholder:text-slate-400 focus:bg-white focus:border-emerald-300 rounded-2xl shadow-sm w-full focus:outline-none"
                    onkeyup="filterPosts(this.value)"
                />
            </div>
        </div>
    </div>
</div>

<!-- Contenuto del Blog -->
<div class="container mx-auto px-4 py-12">
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
        
        <!-- Articoli del Blog -->
        <div class="lg:col-span-3">
            <div id="blog-posts" class="grid grid-cols-1 md:grid-cols-2 gap-8">
                
                <?php
                // Query per recuperare i post del blog
                $blog_posts = new WP_Query(array(
                    'post_type' => 'post',
                    'posts_per_page' => 12,
                    'post_status' => 'publish'
                ));

                if ($blog_posts->have_posts()) :
                    while ($blog_posts->have_posts()) : $blog_posts->the_post();
                        $categories = get_the_category();
                        $category_name = !empty($categories) ? $categories[0]->name : 'Generale';
                        $featured_image = get_the_post_thumbnail_url() ?: 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?w=800&h=400&fit=crop&auto=format';
                        $reading_time = ceil(str_word_count(get_the_content()) / 200);
                ?>

                <article class="bg-white rounded-3xl shadow-sm hover:shadow-lg transition-all duration-300 overflow-hidden group cursor-pointer transform hover:-translate-y-1 border border-emerald-100 blog-post-card"
                         onclick="window.location.href='<?php the_permalink(); ?>'"
                         data-category="<?php echo esc_attr($category_name); ?>"
                         data-title="<?php echo esc_attr(get_the_title()); ?>"
                         data-excerpt="<?php echo esc_attr(get_the_excerpt()); ?>">
                    
                    <div class="relative overflow-hidden">
                        <img src="<?php echo $featured_image; ?>" 
                             alt="<?php the_title(); ?>"
                             class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300">
                        <div class="absolute top-4 left-4">
                            <span class="bg-emerald-500 hover:bg-emerald-600 text-white rounded-full px-3 py-1 text-sm">
                                <?php echo $category_name; ?>
                            </span>
                        </div>
                    </div>
                    
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-slate-800 mb-3 group-hover:text-emerald-600 transition-colors line-clamp-2 leading-relaxed">
                            <?php the_title(); ?>
                        </h3>
                        
                        <p class="text-slate-600 mb-4 line-clamp-3 leading-relaxed">
                            <?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?>
                        </p>
                        
                        <div class="flex flex-wrap gap-2 mb-4">
                            <?php
                            $tags = get_the_tags();
                            if ($tags) :
                                $tag_count = 0;
                                foreach($tags as $tag) :
                                    if ($tag_count >= 3) break;
                            ?>
                                <span class="text-xs rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200 px-2 py-1">
                                    <?php echo $tag->name; ?>
                                </span>
                            <?php 
                                    $tag_count++;
                                endforeach;
                            endif;
                            ?>
                        </div>
                        
                        <div class="flex items-center justify-between text-sm text-slate-500">
                            <div class="flex items-center space-x-4">
                                <div class="flex items-center space-x-2">
                                    <img src="<?php echo get_avatar_url(get_the_author_meta('ID'), array('size' => 24)); ?>" 
                                         alt="<?php the_author(); ?>"
                                         class="w-6 h-6 rounded-full">
                                    <span><?php the_author(); ?></span>
                                </div>
                                
                                <div class="flex items-center space-x-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    <span><?php echo get_the_date('d/m/Y'); ?></span>
                                </div>
                                
                                <div class="flex items-center space-x-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    <span><?php echo $reading_time; ?> min</span>
                                </div>
                            </div>
                            
                            <svg class="w-5 h-5 text-emerald-500 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                            </svg>
                        </div>
                    </div>
                </article>

                <?php 
                    endwhile;
                    wp_reset_postdata();
                endif;
                ?>
                
            </div>

            <!-- Messaggio quando non ci sono risultati -->
            <div id="no-results" class="text-center py-12 hidden">
                <h3 class="text-2xl font-semibold text-slate-600 mb-4">
                    Nessun articolo trovato
                </h3>
                <p class="text-slate-500">
                    Prova a modificare i filtri o la ricerca.
                </p>
            </div>
        </div>
        
        <!-- Sidebar -->
        <div class="lg:col-span-1">
            <div class="space-y-6">
                
                <!-- Categorie -->
                <div class="shadow-sm border border-emerald-100 rounded-2xl bg-white">
                    <div class="p-6 border-b border-emerald-100">
                        <h3 class="text-xl font-semibold text-slate-800">Categorie</h3>
                    </div>
                    <div class="p-6">
                        <div class="space-y-2">
                            <button onclick="filterByCategory('')" class="category-filter active block w-full text-left px-4 py-3 rounded-2xl transition-colors bg-emerald-500 text-white">
                                Tutti gli articoli
                            </button>
                            <?php
                            $categories = get_categories();
                            foreach($categories as $category) :
                            ?>
                            <button onclick="filterByCategory('<?php echo esc_js($category->name); ?>')" 
                                    class="category-filter flex items-center justify-between w-full text-left px-4 py-3 rounded-2xl transition-colors hover:bg-emerald-50 text-slate-700">
                                <span><?php echo $category->name; ?></span>
                                <span class="text-xs rounded-full bg-emerald-50 text-emerald-700 px-2 py-1">
                                    <?php echo $category->count; ?>
                                </span>
                            </button>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>

                <!-- Argomenti -->
                <div class="shadow-sm border border-emerald-100 rounded-2xl bg-white">
                    <div class="p-6 border-b border-emerald-100">
                        <h3 class="text-xl font-semibold text-slate-800">Argomenti</h3>
                    </div>
                    <div class="p-6">
                        <div class="flex flex-wrap gap-2">
                            <?php
                            $popular_tags = array('Ansia', 'Depressione', 'Autostima', 'Relazioni', 'Stress', 'Mindfulness', 'Benessere', 'Crescita');
                            foreach($popular_tags as $tag) :
                            ?>
                            <span class="cursor-pointer hover:bg-emerald-500 hover:text-white hover:border-emerald-500 transition-colors rounded-full border border-emerald-200 text-emerald-700 px-3 py-1 text-sm">
                                <?php echo $tag; ?>
                            </span>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>

                <!-- Call to Action -->
                <div class="shadow-sm border border-emerald-100 rounded-2xl bg-gradient-to-br from-emerald-50 to-teal-50">
                    <div class="p-6 border-b border-emerald-100">
                        <h3 class="text-xl font-semibold text-slate-800">Contattami</h3>
                    </div>
                    <div class="p-6">
                        <p class="text-slate-600 mb-4 leading-relaxed">
                            Hai bisogno di supporto psicologico? Prenota una consulenza.
                        </p>
                        <div class="space-y-3">
                            <button onclick="window.location.href='/contatti'" class="w-full bg-emerald-500 text-white py-3 rounded-2xl hover:bg-emerald-600 transition-colors font-medium">
                                Prenota Consulenza
                            </button>
                            <p class="text-xs text-slate-500 text-center">
                                Studio a Milano, Zona Porta Romana
                            </p>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
        
    </div>
</div>

<script>
let currentCategory = '';

function filterPosts(searchQuery) {
    const posts = document.querySelectorAll('.blog-post-card');
    const noResults = document.getElementById('no-results');
    let visiblePosts = 0;
    
    posts.forEach(post => {
        const title = post.dataset.title.toLowerCase();
        const excerpt = post.dataset.excerpt.toLowerCase();
        const category = post.dataset.category;
        
        const matchesSearch = searchQuery === '' || 
                            title.includes(searchQuery.toLowerCase()) || 
                            excerpt.includes(searchQuery.toLowerCase());
        const matchesCategory = currentCategory === '' || category === currentCategory;
        
        if (matchesSearch && matchesCategory) {
            post.style.display = 'block';
            visiblePosts++;
        } else {
            post.style.display = 'none';
        }
    });
    
    noResults.style.display = visiblePosts === 0 ? 'block' : 'none';
}

function filterByCategory(category) {
    currentCategory = category;
    
    // Aggiorna lo stato attivo dei pulsanti categoria
    document.querySelectorAll('.category-filter').forEach(btn => {
        btn.classList.remove('active', 'bg-emerald-500', 'text-white');
        btn.classList.add('hover:bg-emerald-50', 'text-slate-700');
    });
    
    event.target.classList.add('active', 'bg-emerald-500', 'text-white');
    event.target.classList.remove('hover:bg-emerald-50', 'text-slate-700');
    
    // Applica il filtro
    const searchInput = document.querySelector('input[type="text"]');
    filterPosts(searchInput.value);
}
</script>

</body>
</html>

<?php get_footer(); ?>