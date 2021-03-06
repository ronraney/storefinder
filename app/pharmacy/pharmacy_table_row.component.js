// component that renders a single pharmacy
window.PharmacyRow = React.createClass({
    render: function() {
    return (
        <tr>
            <td>{this.props.pharmacy.name}</td>
            <td>{this.props.pharmacy.address}</td>
            <td>{this.props.pharmacy.city}</td>
            <td>{this.props.pharmacy.state}</td>
            <td>{this.props.pharmacy.zip}</td>
            <td>
                <a href='#'
                    onClick={() => this.props.changeAppMode('readOne', this.props.pharmacy.id)}
                    className='btn btn-info m-r-1em'> Read One
                </a>
                <a href='#'
                    onClick={() => this.props.changeAppMode('update', this.props.pharmacy.id)}
                    className='btn btn-primary m-r-1em'> Edit
                </a>
                <a
                    onClick={() => this.props.changeAppMode('delete', this.props.pharmacy.id)}
                    className='btn btn-danger'> Delete
                </a>
            </td>
        </tr>
        );
    }
});