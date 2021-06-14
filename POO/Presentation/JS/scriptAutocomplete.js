
var cache = {}; /* tableau cache de tous les termes */
var term = null; /* terme renseigné dans le champ input */
var baseUrl = 'https://www.monsite.com/'; /* url du site */
baseUrl = '';

$(document).ready(function() {
    /* tag autocomplete */
    $('#tag').autocomplete({
        minLength:2, /* nombre de caractères minimaux pour lancer une recherche */
        delay:200, /* delais après la dernière touche appuyée avant de lancer une recherche */
        scrollHeight:320,
        appendTo:'#tag-container', /* div ou afficher la liste des résultats, si null, ce sera une div en position fixe avant la fin de </body> */
       
        /* dès qu'une recherche se lance, source est executé, il peut contenir soit un tableau JSON de termes, soit une fonctions qui retournera un résultat */
        source:function(e,t){
            term = e.term; /* récupération du terme renseigné dans l'input */
            if(term in cache){ /* on vérifie que la clé "term" existe dans le tableau "cache", si oui alors on affiche le résultat */
                t(cache[term]);
            }else{ /* sinon on fait une requête ajax vers tag.php pour rechercher "term" */
                $('#loading').attr('style','');
                $.ajax({
                    type:'GET',
                    url:'tag.php',
                    data:'name='+e.term,
                    dataType:"json",
                    async:true,
                    cache:true,
                    success:function(e){
                        cache[term] = e; /* vide ou non, on stocke la liste des résultats avec en clé "term" */
                        if(!e.length){ /* si aucun résultats, on renvoi un tableau vide pour informer qu'on a rien trouvé */
                            var result = [{
                                label: 'Aucun tag trouvé...',
                                value: null,
                                id: null,
                            }];
                            t(result); /* envoit du résultat à source */
                        }else{ /* sinon on renvoit toute la liste */
                            t($.map(e, function (item){
                                return{
                                    label: item.label,
                                    value: item.value,
                                    id: item.id,
                                }
                            }));  /* envoi du résultat à source avec map() de jQuery (permet d'appliquer une fonction pour tous les éléments d'un tableau */
                        }
                        $('#loading').attr('style','display:none;');
                    }
                });
            }
        },
       
        /* sélection depuis la liste des résultats (flèches ou clic) > ajout du résultat automatique et callback */
        select: function(event, ui) {
            $('form input[name="tag-id"]').val(ui.item ? ui.item.id : ''); /* on récupère juste l'id qu'on stocke dans l'autre input */
        },
        open: function() {
            $(this).removeClass("ui-corner-all").addClass("ui-corner-top");
        },
        close: function() {
            $(this).removeClass("ui-corner-top").addClass("ui-corner-all");
        },
    });
});
