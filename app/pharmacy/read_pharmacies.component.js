// component that contains all the logic and other smaller components
// that form the Read Pharmacies view

window.ReadPharmaciesComponent = React.createClass({
    getInitialState: function() {
        return {
            pharmacies: []
        };
    },
 
    // on mount, fetch all pharmacies and stored them as this component's state
    componentDidMount: function() {
 
        this.serverRequest = $.get("http://localhost/rx_finder/read.php", function (pharmacies) {
            this.setState({
                pharmacies: pharmacies.records
            });
        }.bind(this));
    },
 
    // on unmount, kill pharmacy fetching in case the request is still pending
    componentWillUnmount: function() {
        this.serverRequest.abort();
    },
 
    // render component on the page
    render: function() {
        // list of pharmacies
        var filteredPharmacies = this.state.pharmacies;
        $('.page-header h1').text('Read Pharmacies');
 
        return (
            <div className='overflow-hidden'>
                <TopActionsComponent changeAppMode={this.props.changeAppMode} />
 
                <PharmaciesTable
                    pharmacies={filteredPharmacies}
                    changeAppMode={this.props.changeAppMode} />
            </div>
        );
    }
});