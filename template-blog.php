<?php
/*
Template Name: Blog Psicologia
*/

get_header(); 

// Determina se stiamo visualizzando un singolo post
$is_single_post = false;
$single_post = null;

if (isset($_GET['post']) && !empty($_GET['post'])) {
    $post_slug = sanitize_text_field($_GET['post']);
    $single_post = get_page_by_path($post_slug, OBJECT, 'post');
    if ($single_post) {
        $is_single_post = true;
    }
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $is_single_post ? get_the_title($single_post->ID) . ' - ' : ''; ?>Blog - Dott.ssa Maria Rossi Psicologa Milano</title>
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

<?php if ($is_single_post): ?>
    <?php include('template-single-post.php'); ?>
<?php else: ?>
    <?php include('template-blog-list.php'); ?>
    
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

<?php endif; ?>

</body>
</html>

<?php get_footer(); ?>
