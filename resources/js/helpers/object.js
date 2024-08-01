window.pick = (o, ...props) => Object.assign({}, ...props.map((prop) => ({ [prop]: o[prop] })));
