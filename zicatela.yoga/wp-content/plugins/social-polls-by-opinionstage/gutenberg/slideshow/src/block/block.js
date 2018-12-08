import './style.scss';
import './editor.scss';

const { __ } = wp.i18n;
const { registerBlockType } = wp.blocks;
const { SelectControl, TextControl } = wp.components;
const { RichText } = wp.editor ;

var dropdownOptions = false;
var previewBlockOsTitle;
var previewBlockOsImageUrl;
var previewBlockOsView;
var previewBlockOsEdit;
var previewBlockOsStatistics;
var options; 

    registerBlockType( 'opinion-stage/block-os-slideshow', {
        title: __( 'Slideshow' ), 
        icon: 'playlist-video',
        category: 'opinion-stage',        
        keywords: [
            __( 'Opinion Stage Slideshow' ),
            __( 'Opinion Stage Slideshow Insert' ),
        ],        
        attributes: {
            embedUrl: {
                source: 'attribute',
                attribute: 'data-embed-url',
                selector: 'div[data-embed-url]'
            },
            lockEmbed: {
                source: 'attribute',
                attribute: 'data-lock-embed',
                selector: 'div[data-lock-embed]'
            },
            buttonText: {
                source: 'attribute',
                attribute: 'data-button-text',
                selector: 'div[data-button-text]'
            },            
        },
        edit: function( props ) {
            let {attributes: {embedUrl, lockEmbed, buttonText}, setAttributes} = props;
            const onDropdownChange = val => {
                if(val == ''){
                    props.setAttributes({ embedUrl: '' });
                }else if(val != ''){
                    props.setAttributes({ embedUrl: val });
                    for (var i = 0; i < dropdownOptions.length; i++) {
                        var getLandingPageUrlOs = function(href) {
                            var locationUrlOS = document.createElement("a");
                            locationUrlOS.href = href;
                            return locationUrlOS;
                        };
                        var locationUrlOS = getLandingPageUrlOs(dropdownOptions[i].attributes['landing-page-url']);
                        var matchValue = locationUrlOS.pathname;
                        if(val == matchValue){
                            previewBlockOsTitle = dropdownOptions[i].attributes['title'];
                            previewBlockOsImageUrl = dropdownOptions[i].attributes['image-url'];
                            previewBlockOsView = dropdownOptions[i].attributes['landing-page-url'];
                            previewBlockOsEdit = dropdownOptions[i].attributes['edit-url'];
                            previewBlockOsStatistics = dropdownOptions[i].attributes['stats-url'];
                            break;
                        }
                    }                    
                }else{   
                }
            };
            const onEmbedButtonClick = event => {
                if( event.target.value == "Embed" ){
                    if(embedUrl == '' || embedUrl == 'Select' || embedUrl == 'createNew' || embedUrl == 'refresh'){                      
                        props.setAttributes({ lockEmbed: false, buttonText: "Embed" });
                    }else{
                        props.setAttributes({ lockEmbed: true, buttonText: "Change" }); 
                        contentDropdown = (<SelectControl options={options}  value={embedUrl} onChange={onDropdownChange} className="components-select-control__input" />);
                    }
                }else{
                    props.setAttributes({ lockEmbed: false, buttonText: "Embed" });
                }                
            };

            var getOsCreateButtonClickUrl = osGutenData.onCreateButtonClickOs+'?w_type=slideshow&amp;utm_source=wordpress&amp;utm_campaign=WPMainPI&amp;utm_medium=link&amp;o=wp35e8';
            const onCreateButtonClick = value => {
                // Open Create new slideshow link in new page
                window.open(getOsCreateButtonClickUrl, '_blank').focus();
            };

            if(!buttonText){
                props.setAttributes({ buttonText: 'Embed' });
            }

            var getCallBackUrlOs = osGutenData.callbackUrlOs;
            var callback_url = getCallBackUrlOs;
            var formActionUrlOS = osGutenData.getActionUrlOS;
            var getlogoImageLinkOs = osGutenData.getLogoImageLink;

            // Populate list ajax function
            function OsPolulateList() {          
                var opinionStageWidgetVersion = osGutenData.OswpPluginVersion;
                var opinionStageClientToken = osGutenData.OswpClientToken;
                var opinionstageFetchDataUrl = osGutenData.OswpFetchDataUrl+'?type=slideshow&page=1&per_page=99';
                fetch(opinionstageFetchDataUrl, {
                    method: "GET",
                    headers: {
                        'Accept':'application/vnd.api+json',
                        'Content-Type':'application/vnd.api+json',
                        'OSWP-Plugin-Version':opinionStageWidgetVersion,
                        'OSWP-Client-Token': opinionStageClientToken
                    },
                })
                .then(async res => {
                    var data = await res.json();
                    data = data.data;
                    dropdownOptions = data;
                    // force reprinting instead!!
                    props.setAttributes({ buttonText: 'Embed'});
                    props.setAttributes({ buttonText: buttonText});
                    if(buttonText == 'Change' && embedUrl !='Select'){
                        props.setAttributes({ embedUrl: embedUrl });
                    }else{
                        props.setAttributes({ embedUrl: 'Select' });
                    }                    
                })
                .catch(function(err) {
                    console.log('ERROR: ' + err.message);
                });
            }
            // Checking for Opinion Stage connection
            if(osGutenData.isOsConnected == ''){                
                return (
                    <div className={ props.className }>
                        <div className="os-slideshow-wrapper components-placeholder">
                        <div className="components-placeholder__label">Connect WordPress with Opinion Stage to get started</div>
                        <form method="get" action={formActionUrlOS} className="components-placeholder__fieldset">
                            <input type="hidden" name="utm_source" value="wordpress"/>
                            <input type="hidden" name="utm_campaign" value="WPMainPI"/>
                            <input type="hidden" name="utm_medium" value="link"/>
                            <input type="hidden" name="o" value="wp35e8"/>
                            <input type="hidden" name="callback" id="myvalue" value={callback_url} />
                            <input id="os-email" type="email" name="email" placeholder="Enter Your Email" className="components-placeholder__input" data-os-email-input=""/>
                            <button class="opinionstage-connect-btn opinionstage-blue-btn" type="submit" className="components-button is-button is-default is-block is-primary" id="os-start-login" data-os-login="">CONNECT</button>
                        </form>
                        </div>          
                    </div>
                );
            }else{                
                if(dropdownOptions == false){   
                    options = [{value:'Select',label:'Select a Slideshow'},{value:'refresh',label:'Refresh'}];               
                    OsPolulateList();
                   }else{
                    options = [{value:'Select',label:'Select a Slideshow'},{value:'refresh',label:'Refresh'},{value:'',label:'-----------------'}];
                    for (var i = 0; i < dropdownOptions.length; i++) {
                        options[options.length] = {
                            value: dropdownOptions[i].attributes['landing-page-url'].replace('https://www.opinionstage.com',''),
                            label: dropdownOptions[i].attributes['title'],
                        };    
                        var getLandingPageUrlOs = function(href) {
                            var locationUrlOS = document.createElement("a");
                            locationUrlOS.href = href;
                            return locationUrlOS;
                        };
                        var locationUrlOS = getLandingPageUrlOs(dropdownOptions[i].attributes['landing-page-url']);
                        var matchValue = locationUrlOS.pathname;        
                        if(embedUrl == matchValue){
                            previewBlockOsTitle = dropdownOptions[i].attributes['title'];
                            previewBlockOsImageUrl = dropdownOptions[i].attributes['image-url'];
                            previewBlockOsView = dropdownOptions[i].attributes['landing-page-url'];
                            previewBlockOsEdit = dropdownOptions[i].attributes['edit-url'];
                            previewBlockOsStatistics = dropdownOptions[i].attributes['stats-url'];
                        }                          
                    }                   
                }              
                if(embedUrl == 'refresh'){                                            
                    OsPolulateList();   
                }            
                var contentDropdown = (<SelectControl options={options} value={embedUrl}  onChange={onDropdownChange} className="components-select-control__input" />);
                
                var contentViewEditStatOs = ( 
                        <div className="os-slideshow-wrapper components-placeholder">
                            <p className="components-heading"><span><img src={getlogoImageLinkOs} alt=""/></span> Opinion Stage</p>
                            <div className="components-placeholder__label">Select an existing slideshow or create a new one</div>
                            <div className="components-placeholder__fieldset">
                                {contentDropdown}
                                <input type="button" value={buttonText} className="components-button is-button is-default is-large" onClick={onEmbedButtonClick} />  
                                <input type="button" value="Create New Slideshow" className="components-button is-button is-default is-block is-primary" onClick={onCreateButtonClick} />
                            </div>
                        </div>       
                    ); 
                   
                  
                if(embedUrl != '' && embedUrl  != 'Select' && embedUrl){
                    if(buttonText == 'Embed'){ 
                        contentViewEditStatOs
                    }else if(buttonText == 'Change'){   
                        contentViewEditStatOs = (
                           <div className="os-slideshow-wrapper components-placeholder"> 
                              <p className="components-heading"><span><img src={getlogoImageLinkOs} alt=""/></span> Opinion Stage</p>                       
                              <div className="components-preview__block" >                            
                                 <div className="components-preview__leftBlockImage">
                                    <img src={previewBlockOsImageUrl} alt={previewBlockOsTitle} className="image" />
                                    <div className="overlay">
                                       <div className="text">
                                          <a href={previewBlockOsView} classname="components-button is-button is-default is-large" target="_blank"> View </a>
                                          <a href={previewBlockOsEdit} classname="components-button is-button is-default is-large" target="_blank"> Edit </a>
                                          <a href={previewBlockOsStatistics} classname="components-button is-button is-default is-large" target="_blank"> Statistics </a>
                                          <input type="button" value={buttonText} className="components-button is-button is-default is-large left-align" onClick={onEmbedButtonClick} />
                                       </div>                                            
                                    </div>
                                 </div>
                                 <div className="components-preview__rightBlockContent">
                                    <div className="components-placeholder__label">Slideshow: {previewBlockOsTitle}</div>      
                                 </div>
                              </div>
                           </div>
                        );                            
                    contentDropdown = (<SelectControl options={options} value={embedUrl} disabled onChange={onDropdownChange} className="components-select-control__input" />);
                    }
                }else if(embedUrl == 'Select' || embedUrl == '' || embedUrl == 'refresh'){
                    contentViewEditStatOs
                }else{  
                    props.setAttributes({ buttonText: 'Embed'});
                        contentViewEditStatOs 
                }
                return (         
                   <div className={ props.className }>                    
                        {contentViewEditStatOs}        
                    </div>
                );
            }
        },
        save: function( {attributes: {embedUrl, lockEmbed, buttonText}} ) {
            return (
                <div class="os-slideshow-wrapper" data-type="slideshow" data-embed-url={embedUrl} data-lock-embed={lockEmbed} data-button-text={buttonText}>
                    [os-widget path="{embedUrl}"]
                </div>
            );
        },
    } );