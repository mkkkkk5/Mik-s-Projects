import db from '../db'
import React, { useState, useEffect,useContext } from "react";
import { makeStyles } from "@material-ui/core/styles";
import GridContainer from "../components/Grid/GridContainer.js";
import styles from "../assets/jss/material-kit-react/views/landingPageSections/productStyle.js";
import UserContext from '../UserContext';
import Card from "../components/Card/Card.js";

// import {
//     Link
// } from "react-router-dom";
import CardContent from '@material-ui/core/CardContent';
import Typography from '@material-ui/core/Typography';

const useStyles = makeStyles(styles);
export default function BidsByUnfinishedAuctions(id) {
    const {user}=useContext(UserContext)
    const classes = useStyles();

    // //console.log("printing id from BidsByUnfinishedAuctions...", id)

    const [auctionBids, setAuctionBids] = useState([])
    //   listenAuctionBidByUser
    //   useEffect(async () => setAuctionBids(await db.Auctions.Bids.findOneAuctionAllBids(id.id)), [])

    useEffect(
        () => {
            const getData = async () => {
                setAuctionBids(await db.Auctions.Bids.findOneAuctionAllBids(id.id))
            }
            getData()
        },
        [id.id]
    )

    return (
        // <span key={id.id}>po</span>
        <div className={classes.section}>
            <GridContainer justify="center">
                {
                    auctionBids.map((bid, i) =>
                        bid.buyerId === user.id ?
                            <div key={i}>
                                <Card >
                                {/* key={bid.id} */}
                                    <CardContent>
                                        <Typography color="textSecondary" gutterBottom>
                                            Bid Id:
                                        </Typography>
                                        <Typography variant="h5" component="h2">
                                            {`${bid.id}`}
                                        </Typography>
                                        <Typography color="textSecondary" gutterBottom>
                                            Bid Amount:
                                        </Typography>
                                        <Typography variant="h5" component="h2">
                                            {`${bid.amount}`}
                                        </Typography>
                                        <Typography color="textSecondary" gutterBottom>
                                            When:
                                        </Typography>
                                        <Typography variant="h5" component="h2">
                                            {`${bid.when}`}
                                        </Typography>
                                    </CardContent>
                                </Card>
                            </div>
                            :
                            <h1>No bid with current auction</h1>,
                            // <Button size="sm" component={Link} to={"/"} >Back to Home Page</Button>
                    )
                }
            </GridContainer>
        </div>
    )
}
