<?php
// File per la sidebar del blog
// Incluso da template-blog-list.php
?>

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
