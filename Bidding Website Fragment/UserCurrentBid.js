import db from '../db'
import React, { useState, useEffect, useContext } from "react";
import UserContext from '../UserContext'
import { makeStyles } from "@material-ui/core/styles";
import GridContainer from "../components/Grid/GridContainer.js";
import GridItem from "../components/Grid/GridItem.js";
import styles from "../assets/jss/material-kit-react/views/landingPageSections/productStyle.js";
// import Card from "../components/Card/Card.js";
// import CardContent from '@material-ui/core/CardContent';
import Button from '@material-ui/core/Button';
// import Typography from '@material-ui/core/Typography';
import Bid from '../Hamad/Bid'
import {
  Link
} from "react-router-dom";
import Table from '@material-ui/core/Table';
import TableBody from '@material-ui/core/TableBody';
import TableCell from '@material-ui/core/TableCell';
import TableContainer from '@material-ui/core/TableContainer';
import TableHead from '@material-ui/core/TableHead';
import TableRow from '@material-ui/core/TableRow';
import Paper from '@material-ui/core/Paper';
const useStyles = makeStyles(styles);
export default function UserCurrentBid() {
  const { user } = useContext(UserContext)

  const classes = useStyles();

  const [userBids, setUserBids] = useState([])
  // useEffect(async () => setUserBids(await db.Auctions.Bids.findAuctionBidByUser(user.id)), [])
  useEffect(
    () => {
      const getBids = async () => {
        setUserBids(await db.Auctions.Bids.findAuctionBidByUser(user.id))
      }
      getBids() 
    },[user.id]
  )
  return (
    <div className={classes.section}>
      <GridContainer key={123} justify="center">
        <GridItem xs={12} sm={12} md={8}>
          <h2 className={classes.title}>All User Bids</h2>
        </GridItem>
      </GridContainer>
      <GridContainer>
      <TableContainer component={Paper}>
                <Table className={classes.table} aria-label="simple table">
                    <TableHead>
                        <TableRow>
                            <TableCell>Bidder</TableCell>
                            <TableCell>Amount</TableCell>
                            <TableCell>Time</TableCell>
                        </TableRow>
                    </TableHead>
                    <TableBody>
                        {
                            userBids.map((bid) => 
                            <Bid key={bid.id} amount={bid.amount} userId={bid.buyerId} time={bid.when} />
                            )
                        }
                    </TableBody>
                </Table>
            </TableContainer>
        {/* {
          userBids.map(userBid =>
            userBid?
            <>
              <Card key={userBid.id}>
                <CardContent key={userBid.id+1}>
                  <Typography color="textSecondary" gutterBottom>
                    Bid Id:
                  </Typography>
                  <Typography variant="h5" component="h2">
                    {`${userBid.id}`}
                  </Typography>

                  <Typography color="textSecondary" gutterBottom>
                    Bid Amount:
                  </Typography>
                  <Typography variant="h5" component="h2">
                    {`${userBid.amount}`}
                  </Typography>

                  <Typography color="textSecondary" gutterBottom>
                    When:
                  </Typography>
                  <Typography variant="h5" component="h2">
                    {`${userBid.when}`}
                  </Typography>

                </CardContent>
              </Card> 
            
            </>
            :
            <h1 key={userBid.id}>No Bids ever made</h1>
          )
        } */}
        <Button size="small" component={Link} to={"/"} >Back to Home Page</Button>
      </GridContainer>
    </div>
  )
}
